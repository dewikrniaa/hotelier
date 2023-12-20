<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select * from laporan"));
        return view('laporan.index',compact('data'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('laporan.create');
        //
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
            'tanggal_keluar' => 'required',
            'transaksi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
            'total' => 'required'
        ]);

        //upload image
        $image = $request->file('transaksi');
        $image->storeAs('public/laporan',$image->hashName());

        DB::insert("INSERT INTO `laporan` (`id`,`tanggal_masuk`,`tanggal_keluar`,`transaksi`,`total`) values (uuid(),?,?,?,?)",
        [$request->tanggal_masuk,$request->tanggal_keluar,$image->hashName(),$request->total]);
        return redirect()->route('laporan.index')->with(['success'=>'Data Berhasil Disimpan']);
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
        $data=DB::table('laporan')->where('id',$id)->first();
        return view('laporan.edit',compact('data'));
        //
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
            'tanggal_keluar' => 'required',
            'transaksi' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',  
            'total' => 'required',
        ]);

        //cek update foto
        if($request->file('transaksi')){
            $image = $request->file('transaksi');
        $image->storeAs('public/laporan',$image->hashName());

            DB::update("UPDATE `laporan` SET `tanggal_masuk`=?,`tanggal_keluar`=?,`transaksi`=?,`total`=? WHERE id=?",
            [$request->tanggal_masuk,$request->tanggal_keluar,$image->hashName(),$request->total,$id]);

        }else{
            DB::update("UPDATE `laporan` SET `tanggal_masuk`=?,`tanggal_keluar`=?,`total`=? WHERE id=?",
            [$request->tanggal_masuk,$request->tanggal_keluar,$request->total,$id]);
        }
        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('laporan')->where('id', $id)->delete();
        
        //redirect to index
        return redirect()->route('laporan.index')->with(['success' => 'Data Berhasil Dihapus!']);
        //
    }
}