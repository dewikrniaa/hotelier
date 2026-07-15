<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalkamar = DB::table('kamar')->count();

        $totalkamartersedia = DB::table('kamar')
            ->where('status', 'Tersedia')
            ->count();

        $totalkamarkotor = DB::table('kamar')
            ->where('status', 'Maintenance')
            ->count();

        // ✅ HANYA YANG SUDAH LUNAS
        $total_pendapatan = DB::table('checkin')
            ->where('status_pembayaran', 'Lunas')
            ->sum('total_harga');

        return view(
            'layouts.dashboard',
            compact(
                'totalkamar',
                'totalkamartersedia',
                'totalkamarkotor',
                'total_pendapatan'
            )
        );
    }
}
