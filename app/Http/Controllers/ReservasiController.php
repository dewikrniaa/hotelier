<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class ReservasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select * from reservasi"));
        return view('reservasi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reservasi.create');
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
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'required'
        ]);

        DB::insert("INSERT INTO `reservasi` (`id_reservasi`,`nama`,`tanggal_masuk`, `tanggal_keluar`) VALUES (uuid(), ?, ?, ?)",
        [$request->nama,$request->tanggal_masuk,$request->tanggal_keluar]);
        return redirect()->route('reservasi.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $data=DB::table('reservasi')->where('id_reservasi',$id)->first();
        return view('reservasi.edit', compact('data'));
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
            'tanggal_masuk' => 'required',
            'tanggal_keluar' => 'required'
        ]);
        
        
            DB::update("UPDATE `reservasi` SET `nama`=?,`tanggal_masuk`=?,`tanggal_keluar`=? WHERE id_reservasi=?",
            [$request->nama,$request->tanggal_masuk,$request->tanggal_keluar,$id]);
        
        return redirect()->route('reservasi.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('reservasi')->where('id_reservasi', $id)->delete();
        
        //redirect to index
        return redirect()->route('reservasi.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
