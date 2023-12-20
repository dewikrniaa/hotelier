<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class CheckinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=DB::select(DB::raw("select * from checkin"));
        return view('checkin.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('checkin.create');
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
            'no_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'tipe_kamar' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'jumlah_orang' => 'required'
        ]);

        DB::insert("INSERT INTO `checkin` (`id`,`nama`, `no_hp`, `email`, `alamat`, `tipe_kamar`, `checkin_date`, `checkout_date`, `jumlah_orang`) VALUES (uuid(), ?, ?, ?, ?, ?, ?, ?, ?)",
        [$request->nama,$request->no_hp,$request->email,$request->alamat,$request->tipe_kamar,$request->checkin_date,$request->checkout_date,$request->jumlah_orang]);
        return redirect()->route('checkin.index')->with(['success' => 'Data Berhasil Disimpan!']);
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
        $data=DB::table('checkin')->where('id',$id)->first();
        return view('checkin.edit', compact('data'));
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
            'no_hp' => 'required',
            'email' => 'required',
            'alamat' => 'required',
            'tipe_kamar' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'jumlah_orang' => 'required'
        ]);
        
        
            DB::update("UPDATE `checkin` SET `nama`=?,`no_hp`=?,`email`=?,`alamat`=?,`tipe_kamar`=?,`checkin_date`=?,`checkout_date`=?,`jumlah_orang`=? WHERE id=?",
            [$request->nama,$request->no_hp,$request->email,$request->alamat,$request->tipe_kamar,$request->checkin_date,$request->checkout_date,$request->jumlah_orang,$id]);
        
        return redirect()->route('checkin.index')->with(['success' => 'Data Berhasil Diupdate!']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('checkin')->where('id', $id)->delete();
        
        //redirect to index
        return redirect()->route('checkin.index')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
