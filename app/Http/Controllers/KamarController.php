<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class KamarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select * from kamar"));
        return view('kamar.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('kamar.create');
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
            'no_kamar' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required'
        ]);

        DB::insert("INSERT INTO `kamar` (`id_kamar`,`no_kamar`, `status`, `jumlah`, `tipe_kamar`, `harga`) VALUES (uuid(), ?, ?, ?, ?, ?)",
        [$request->no_kamar,$request->status,$request->jumlah,$request->tipe_kamar,$request->harga]);
        return redirect()->route('kamar.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $data=DB::table('kamar')->where('id_kamar',$id)->first();
        return view('kamar.edit', compact('data'));
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
            'no_kamar' => 'required',
            'status' => 'required',
            'jumlah' => 'required',
            'tipe_kamar' => 'required',
            'harga' => 'required'
        ]);
        
        
            DB::update("UPDATE `kamar` SET `no_kamar`=?,`status`=?,`jumlah`=?,`tipe_kamar`=?,`harga`=? WHERE id_kamar=?",
            [$request->no_kamar,$request->status,$request->jumlah,$request->tipe_kamar,$request->harga,$id]);
        
        return redirect()->route('kamar.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('kamar')->where('id_kamar', $id)->delete();
        
        //redirect to index
        return redirect()->route('kamar.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
