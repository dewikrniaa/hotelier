<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PelangganController extends Controller
{
    public function index()
    {
        $data = DB::table('pelanggan')->get();
        return view('pelanggan.index', compact('data'));
    }

    public function create()
    {
        return view('pelanggan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'nik'       => 'required|digits:16',
            'foto_ktp' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:2048',
            ],
            'email'     => 'required|email',
            'alamat'    => 'required|string|max:255',
            'no_hp'     => ['required', 'regex:/^\+62[0-9]{8,13}$/'],
        ]);

        // Simpan file KTP
        $fotoKtp = $request->file('foto_ktp');
        $fotoKtp->storeAs('ktp', $fotoKtp->hashName());

        $idPelanggan = (string) \Illuminate\Support\Str::uuid();

        DB::table('pelanggan')->insert([
            'id_pelanggan' => $idPelanggan,
            'nama'         => $request->nama,
            'nik'          => $request->nik,
            'foto_ktp'     => $fotoKtp->hashName(),
            'email'        => $request->email,
            'alamat'       => $request->alamat,
            'no_hp'        => $request->no_hp,
            'created_at'        => now(),
            'updated_at'        => now(),
        ]);

        auditLog(
            'CREATE',
            'pelanggan',
            $idPelanggan,
            'Menambahkan data pelanggan baru'
        );

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data Berhasil Disimpan!');
    }

    public function edit($id)
    {
        $data = DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->first();

        return view('pelanggan.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama'      => 'required|string|max:100',
            'nik'       => 'required|digits:16',
            'foto_ktp' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,pdf',
                'mimetypes:image/jpeg,image/png,application/pdf',
                'max:2048',
            ],
            'email'     => 'required|email',
            'alamat'    => 'required|string|max:255',
            'no_hp'     => ['required', 'regex:/^\+62[0-9]{8,13}$/'],
        ]);

        $dataUpdate = [
            'nama'   => $request->nama,
            'nik'    => $request->nik,
            'email'  => $request->email,
            'alamat' => $request->alamat,
            'no_hp'  => $request->no_hp,
            'updated_at'        => now(),
        ];

        // Jika upload KTP baru
        if ($request->hasFile('foto_ktp')) {
            $old = DB::table('pelanggan')
                ->where('id_pelanggan', $id)
                ->value('foto_ktp');

            if ($old) {
                Storage::delete('ktp/' . $old);
            }

            $fotoKtp = $request->file('foto_ktp');
            $fotoKtp->storeAs('ktp', $fotoKtp->hashName());
            $dataUpdate['foto_ktp'] = $fotoKtp->hashName();
        }

        DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->update($dataUpdate);

        auditLog(
            'UPDATE',
            'pelanggan',
            $id,
            'Mengedit data pelanggan'
        );

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy($id)
    {
        $foto = DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->value('foto_ktp');

        if ($foto) {
            Storage::delete('ktp/' . $foto);
        }

        DB::table('pelanggan')
            ->where('id_pelanggan', $id)
            ->delete();

        auditLog(
            'DELETE',
            'pelanggan',
            $id,
            'Menghapus data pelanggan'
        );

        return redirect()->route('pelanggan.index')
            ->with('success', 'Data Berhasil Dihapus!');
    }
}
