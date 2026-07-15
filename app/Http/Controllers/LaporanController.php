<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = DB::table('checkin')
            ->where('status_pembayaran', 'Lunas') // 🔥 FILTER
            ->selectRaw('
            YEAR(checkin_date) as tahun,
            MONTH(checkin_date) as bulan,
            DAY(checkin_date) as tanggal,
            COUNT(*) as jumlah_check_in,
            SUM(total_harga) as total_transaksi
        ')
            ->groupByRaw('YEAR(checkin_date), MONTH(checkin_date), DAY(checkin_date)')
            ->orderByDesc('tahun')
            ->orderByDesc('bulan')
            ->orderByDesc('tanggal')
            ->get();

        $total_pendapatan = DB::table('checkin')
            ->where('status_pembayaran', 'Lunas') // 🔥 FILTER
            ->sum('total_harga');

        return view('laporan.index', compact('laporan', 'total_pendapatan'));
    }


    public function export(Request $request)
    {
        $request->validate([
            'periode' => 'required|in:harian,bulanan,tahunan',
            'format'  => 'required|in:pdf,excel'
        ]);

        // ===== DATA =====
        if ($request->periode === 'harian') {
            $laporan = DB::table('checkin')
                ->where('status_pembayaran', 'Lunas')
                ->selectRaw('DATE(checkin_date) as periode, COUNT(*) as jumlah_check_in, SUM(total_harga) as total_transaksi')
                ->groupByRaw('DATE(checkin_date)')
                ->get();
        } elseif ($request->periode === 'bulanan') {
            $laporan = DB::table('checkin')
                ->where('status_pembayaran', 'Lunas')
                ->selectRaw('YEAR(checkin_date) as tahun, MONTH(checkin_date) as bulan, COUNT(*) as jumlah_check_in, SUM(total_harga) as total_transaksi')
                ->groupByRaw('YEAR(checkin_date), MONTH(checkin_date)')
                ->get();
        } else {
            $laporan = DB::table('checkin')
                ->where('status_pembayaran', 'Lunas')
                ->selectRaw('YEAR(checkin_date) as periode, COUNT(*) as jumlah_check_in, SUM(total_harga) as total_transaksi')
                ->groupByRaw('YEAR(checkin_date)')
                ->get();
        }

        $total_pendapatan = $laporan->sum('total_transaksi');

        // ===== PDF =====
        if ($request->format === 'pdf') {
            return Pdf::loadView('laporan.export-pdf', [
                'laporan' => $laporan,
                'periode' => $request->periode,
                'total_pendapatan' => $total_pendapatan
            ])->download('laporan-' . $request->periode . '.pdf');
        }

        // ===== EXCEL (.xlsx) =====
        return Excel::download(
            new LaporanExport($laporan, $request->periode),
            'laporan-' . $request->periode . '.xlsx'
        );
    }
}
