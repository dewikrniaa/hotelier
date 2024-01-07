<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Checkin;
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
        $data = DB::table('checkin')->join('pelanggan', 'checkin.id_pelanggan', '=', 'pelanggan.id_pelanggan')->join('kamar', 'checkin.id_kamar', '=', 'kamar.id_kamar')->get();
        return view('checkin.index',['data'=>$data]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pelanggan=DB::select(DB::raw("select * from pelanggan"));
        $kamar=DB::table('kamar')->where('status','Tersedia')->get();
        return view('checkin.create', compact('pelanggan','kamar'));
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
            'id_pelanggan' => 'required',
            'id_kamar' => 'required',
            'status' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'jumlah_orang' => 'required'
        ]);
        $checkin=new DateTime($request->checkin_date);
        $checkout=new DateTime($request->checkout_date);
        $jarak=$checkin->diff($checkout);
        
        $harga = DB::table("kamar")->where('id_kamar', '=', $request->id_kamar)->select('harga')->first();
        $total_harga = $harga->harga * $jarak->days;
        
        if($request->status=="Checkout"){
            DB::update("UPDATE `kamar` SET `status`='Tersedia' WHERE id_kamar=?",
            [$request->id_kamar]);
        }else{
            DB::update("UPDATE `kamar` SET `status`='Terpesan' WHERE id_kamar=?",
            [$request->id_kamar]);
        }

        DB::insert("INSERT INTO `checkin` (`id`,`checkin_date`, `checkout_date`, `jumlah_orang`, `id_pelanggan`, `id_kamar`, `total_harga`, `status_checkin`) VALUES (uuid(), ?, ?, ?, ?, ?, ?, ?)",
        [$request->checkin_date,$request->checkout_date,$request->jumlah_orang,$request->id_pelanggan,$request->id_kamar,$total_harga,$request->status]);
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
        $pelanggan=DB::select(DB::raw("select * from pelanggan"));
        $kamar=DB::select(DB::raw("select * from kamar"));
        $data=DB::table('checkin')->where('id',$id)->first();
        return view('checkin.edit', compact('data','pelanggan','kamar'));
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
            'id_pelanggan' => 'required',
            'id_kamar' => 'required',
            'status' => 'required',
            'checkin_date' => 'required',
            'checkout_date' => 'required',
            'jumlah_orang' => 'required'
        ]);
        $checkin=new DateTime($request->checkin_date);
        $checkout=new DateTime($request->checkout_date);
        $jarak=$checkin->diff($checkout);
        
        $harga = DB::table("kamar")->where('id_kamar', '=', $request->id_kamar)->select('harga')->first();
        $total_harga = $harga->harga * $jarak->days;
        
        if($request->status=="Checkout"){
            DB::update("UPDATE `kamar` SET `status`='Tersedia' WHERE id_kamar=?",
            [$request->id_kamar]);
        }else{
            DB::update("UPDATE `kamar` SET `status`='Terpesan' WHERE id_kamar=?",
            [$request->id_kamar]);
        }

        
        
            DB::update("UPDATE `checkin` SET `id_pelanggan`=?,`id_kamar`=?,`status_checkin`=?,`checkin_date`=?,`checkout_date`=?,`jumlah_orang`=?,`total_harga`=? WHERE id=?",
            [$request->id_pelanggan,$request->id_kamar,$request->status,$request->checkin_date,$request->checkout_date,$request->jumlah_orang,$total_harga,$id]);
        
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
