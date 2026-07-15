<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckinController extends Controller
{
    /**
     * TAMPIL DATA CHECK-IN
     */
    public function index()
    {
        $data = DB::table('checkin')
            ->join('pelanggan', 'checkin.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('kamar', 'checkin.id_kamar', '=', 'kamar.id_kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->select(
                'checkin.*',
                'pelanggan.nama',
                'kamar.no_kamar',
                'tipe_kamar.nama_tipe',
                'tipe_kamar.harga'
            )
            ->get();

        return view('checkin.index', compact('data'));
    }

    /**
     * FORM CHECK-IN
     */
    public function create()
    {
        $pelanggan = DB::table('pelanggan')->get();

        $kamar = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->where('kamar.status', 'Tersedia')
            ->select(
                'kamar.id_kamar',
                'kamar.no_kamar',
                'tipe_kamar.nama_tipe',
                'tipe_kamar.harga',
                'tipe_kamar.kapasitas'
            )
            ->get();

        return view('checkin.create', compact('pelanggan', 'kamar'));
    }

    /**
     * SIMPAN CHECK-IN
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_pelanggan'  => 'required|exists:pelanggan,id_pelanggan',
            'id_kamar'      => 'required|exists:kamar,id_kamar',
            'checkin_date'  => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $checkin  = new DateTime($request->checkin_date);
        $checkout = new DateTime($request->checkout_date);
        $lamaInap = max(1, $checkin->diff($checkout)->days);

        $harga = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->where('kamar.id_kamar', $request->id_kamar)
            ->value('tipe_kamar.harga');

        $total_harga = $harga * $lamaInap;

        $idCheckin = (string) \Illuminate\Support\Str::uuid();

        DB::table('checkin')->insert([
            'id'                => $idCheckin,
            'id_pelanggan'      => $request->id_pelanggan,
            'id_kamar'          => $request->id_kamar,
            'checkin_date'      => $request->checkin_date,
            'checkout_date'     => $request->checkout_date,
            'total_harga'       => $total_harga,
            'status_checkin'    => 'Aktif',
            'status_pembayaran' => 'Belum Bayar',
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        DB::table('kamar')
            ->where('id_kamar', $request->id_kamar)
            ->update(['status' => 'Terpesan']);

        auditLog(
            'CHECKIN',
            'checkin',
            $idCheckin,
            'Proses check-in pelanggan'
        );

        return redirect()->route('checkin.index')
            ->with('success', 'Check-in berhasil');
    }

    /**
     * FORM EDIT CHECK-IN
     */
    public function edit($id)
    {
        $data = DB::table('checkin')->where('id', $id)->first();

        if ($data->status_checkin === 'Checkout' || $data->status_pembayaran === 'Lunas') {
            return redirect()->route('checkin.index')
                ->with('error', 'Data yang sudah checkout tidak bisa diedit');
        }

        $pelanggan = DB::table('pelanggan')->get();

        $kamar = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->select(
                'kamar.id_kamar',
                'kamar.no_kamar',
                'tipe_kamar.nama_tipe',
                'tipe_kamar.harga'
            )
            ->get();

        return view('checkin.edit', compact('data', 'pelanggan', 'kamar'));
    }

    /**
     * UPDATE CHECK-IN
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_pelanggan'  => 'required|exists:pelanggan,id_pelanggan',
            'id_kamar'      => 'required|exists:kamar,id_kamar',
            'checkin_date'  => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
        ]);

        $checkin  = new DateTime($request->checkin_date);
        $checkout = new DateTime($request->checkout_date);
        $lamaInap = max(1, $checkin->diff($checkout)->days);

        $harga = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->where('kamar.id_kamar', $request->id_kamar)
            ->value('tipe_kamar.harga');

        $total_harga = $harga * $lamaInap;

        DB::table('checkin')
            ->where('id', $id)
            ->update([
                'id_pelanggan'  => $request->id_pelanggan,
                'id_kamar'      => $request->id_kamar,
                'checkin_date'  => $request->checkin_date,
                'checkout_date' => $request->checkout_date,
                'total_harga'   => $total_harga,
                'updated_at'        => now(),
            ]);

        auditLog(
            'UPDATE',
            'checkin',
            $id,
            'Update check-in pelanggan'
        );

        return redirect()->route('checkin.index')
            ->with('success', 'Data check-in diperbarui');
    }

    /**
     * HALAMAN PEMBAYARAN
     */
    public function bayar($id)
    {
        $data = DB::table('checkin')
            ->join('pelanggan', 'checkin.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('kamar', 'checkin.id_kamar', '=', 'kamar.id_kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->select(
                'checkin.*',
                'pelanggan.nama',
                'kamar.no_kamar',
                'tipe_kamar.nama_tipe'
            )
            ->where('checkin.id', $id)
            ->first();

        if ($data->status_pembayaran === 'Lunas') {
            return redirect()->route('checkin.index')
                ->with('error', 'Pembayaran sudah dilakukan');
        }

        return view('checkin.bayar', compact('data'));
    }
    /**
     * LIHAT INVOICE (HANYA JIKA LUNAS)
     */
    public function invoice($id)
    {
        $data = DB::table('checkin')
            ->join('pelanggan', 'checkin.id_pelanggan', '=', 'pelanggan.id_pelanggan')
            ->join('kamar', 'checkin.id_kamar', '=', 'kamar.id_kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->select(
                'checkin.*',
                'pelanggan.nama',
                'kamar.no_kamar',
                'tipe_kamar.nama_tipe'
            )
            ->where('checkin.id', $id)
            ->first();

        // 🔒 Proteksi invoice
        if (!$data || $data->status_pembayaran !== 'Lunas') {
            return redirect()->route('checkin.index')
                ->with('error', 'Invoice hanya tersedia untuk pembayaran lunas');
        }

        return view('checkin.bayar', compact('data'));
    }

    /**
     * PROSES PEMBAYARAN
     */
    public function prosesBayar(Request $request, $id)
    {
        $request->validate([
            'metode_pembayaran' => 'required'
        ]);

        DB::table('checkin')
            ->where('id', $id)
            ->update([
                'status_pembayaran' => 'Lunas',
                'metode_pembayaran' => $request->metode_pembayaran,
                'tanggal_bayar'     => now(),
                'updated_at'        => now(),
            ]);

        auditLog(
            'PAYMENT',
            'checkin',
            $id,
            'Pembayaran check-in'
        );

        return redirect()->route('checkin.index')
            ->with('success', 'Pembayaran berhasil');
    }

    /**
     * CHECKOUT (HARUS LUNAS)
     */
    public function checkout($id)
    {
        $checkin = DB::table('checkin')->where('id', $id)->first();

        if (!$checkin) {
            return redirect()->route('checkin.index')
                ->with('error', 'Data check-in tidak ditemukan');
        }

        if ($checkin->status_checkin === 'Checkout') {
            return redirect()->route('checkin.index')
                ->with('error', 'Check-in ini sudah checkout');
        }

        if ($checkin->status_pembayaran !== 'Lunas') {
            return redirect()->route('checkin.index')
                ->with('error', 'Checkout ditolak. Pembayaran belum lunas');
        }

        DB::transaction(function () use ($checkin, $id) {

            // Update status check-in
            DB::table('checkin')
                ->where('id', $id)
                ->update([
                    'status_checkin' => 'Checkout',
                    'updated_at' => now()
                ]);

            // 🔥 Setelah checkout → kamar masuk MAINTENANCE
            DB::table('kamar')
                ->where('id_kamar', $checkin->id_kamar)
                ->update([
                    'status' => 'Maintenance',
                    'updated_at' => now()
                ]);
        });

        auditLog(
            'CHECKOUT',
            'checkin',
            $id,
            'Checkout pelanggan, kamar masuk maintenance'
        );

        return redirect()->route('checkin.index')
            ->with('success', 'Checkout berhasil, kamar masuk maintenance');
    }

    /**
     * HAPUS DATA
     */

    public function destroy($id)
    {
        // Ambil data check-in dulu
        $checkin = DB::table('checkin')->where('id', $id)->first();

        if (!$checkin) {
            return redirect()->route('checkin.index')
                ->with('error', 'Data check-in tidak ditemukan');
        }

        DB::transaction(function () use ($checkin, $id) {

            // Jika belum checkout → kembalikan status kamar
            if ($checkin->status_checkin !== 'Checkout') {
                DB::table('kamar')
                    ->where('id_kamar', $checkin->id_kamar)
                    ->update([
                        'status' => 'Tersedia',
                        'updated_at' => now()
                    ]);
            }

            // Hapus data check-in
            DB::table('checkin')
                ->where('id', $id)
                ->delete();
        });

        auditLog(
            'DELETE',
            'checkin',
            $id,
            'Menghapus data check-in pelanggan'
        );

        return redirect()->route('checkin.index')
            ->with('success', 'Data check-in berhasil dihapus');
    }
}
