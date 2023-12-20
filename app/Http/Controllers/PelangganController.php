<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::select(DB::raw("select * from pelanggan"));
        return view('pelanggan.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pelanggan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);

        DB::insert(
            "INSERT INTO `pelanggan` (`id_pelanggan`, `nama`, `email`, `alamat`, `no_hp`) VALUES (uuid(), ?, ?, ?, ?)",
            [$request->nama, $request->email, $request->alamat, $request->no_hp]
        );
        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('pelanggan')->where('id_pelanggan', $id)->first();
        return view('pelanggan.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required'
        ]);


        DB::update(
            "UPDATE `pelanggan` SET `nama`=?,`email`=?,`alamat`=?,`no_hp`=? WHERE id_pelanggan=?",
            [$request->nama, $request->email, $request->alamat, $request->no_hp, $id]
        );

        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('pelanggan')->where('id_pelanggan', $id)->delete();

        //redirect to index
        return redirect()->route('pelanggan.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
