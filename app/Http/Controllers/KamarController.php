<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KamarController extends Controller
{
    /**
     * TAMPIL DATA KAMAR + JOIN TIPE KAMAR
     */
    public function index()
    {
        $data = DB::table('kamar')
            ->join('tipe_kamar', 'kamar.tipe_kamar_id', '=', 'tipe_kamar.id')
            ->select(
                'kamar.id_kamar',
                'kamar.no_kamar',
                'kamar.status',
                'tipe_kamar.nama_tipe',
                'tipe_kamar.harga',
                'tipe_kamar.kapasitas'
            )
            ->get();

        return view('kamar.index', compact('data'));
    }

    /**
     * FORM TAMBAH KAMAR
     */
    public function create()
    {
        $tipeKamar = DB::table('tipe_kamar')->get();
        return view('kamar.create', compact('tipeKamar'));
    }

    /**
     * SIMPAN DATA KAMAR
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_kamar'      => 'required|string|max:10|unique:kamar,no_kamar',
            'status'        => 'required|in:Tersedia,Maintenance',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
        ]);

        $idKamar = (string) \Illuminate\Support\Str::uuid();

        DB::table('kamar')->insert([
            'id_kamar'      => $idKamar,
            'no_kamar'      => $request->no_kamar,
            'status'        => $request->status,
            'tipe_kamar_id' => $request->tipe_kamar_id,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        auditLog(
            'CREATE',
            'kamar',
            $idKamar,
            'Menambahkan data kamar baru'
        );

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil disimpan');
    }

    /**
     * FORM EDIT KAMAR
     */
    public function edit($id)
    {
        $data = DB::table('kamar')
            ->where('id_kamar', $id)
            ->first();

        $tipeKamar = DB::table('tipe_kamar')->get();

        return view('kamar.edit', compact('data', 'tipeKamar'));
    }

    /**
     * UPDATE DATA KAMAR
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'no_kamar'      => 'required|string|max:10|unique:kamar,no_kamar,' . $id . ',id_kamar',
            'status'        => 'required|in:Tersedia,Maintenance',
            'tipe_kamar_id' => 'required|exists:tipe_kamar,id',
        ]);

        DB::table('kamar')
            ->where('id_kamar', $id)
            ->update([
                'no_kamar'      => $request->no_kamar,
                'status'        => $request->status,
                'tipe_kamar_id' => $request->tipe_kamar_id,
                'updated_at'        => now(),
            ]);

        auditLog(
            'UPDATE',
            'kamar',
            $id,
            'Mengubah data kamar'
        );

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil diperbarui');
    }

    /**
     * SELESAI MAINTENANCE
     */
    public function selesaiMaintenance($id)
    {
        $kamar = DB::table('kamar')->where('id_kamar', $id)->first();

        if (!$kamar) {
            return redirect()->route('kamar.index')
                ->with('error', 'Data kamar tidak ditemukan');
        }

        // hanya boleh jika maintenance
        if ($kamar->status !== 'Maintenance') {
            return redirect()->route('kamar.index')
                ->with('error', 'Kamar tidak dalam status maintenance');
        }

        DB::table('kamar')
            ->where('id_kamar', $id)
            ->update([
                'status' => 'Tersedia',
                'updated_at' => now(),
            ]);

        auditLog(
            'UPDATE',
            'kamar',
            $id,
            'Menyelesaikan maintenance kamar'
        );

        return redirect()->route('kamar.index')
            ->with('success', 'Maintenance kamar selesai. Status berubah menjadi Tersedia');
    }

    /**
     * HAPUS DATA KAMAR
     */
    public function destroy($id)
    {
        DB::table('kamar')
            ->where('id_kamar', $id)
            ->delete();

        auditLog(
            'DELETE',
            'kamar',
            $id,
            'Menghapus data kamar'
        );

        return redirect()->route('kamar.index')
            ->with('success', 'Data kamar berhasil dihapus');
    }
}
