<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalkamar = DB::table('kamar')->count();
        $totalkamartersedia = DB::table('kamar')->where('status', 'Tersedia')->count();
        $totalkamarkotor = DB::table('kamar')->where('status', 'Maintenance')->count();
        $total_pendapatan = DB::table('checkin')->sum('total_harga');
        // Pass all variables in a single array
        return view(
            'layouts.dashboard',
            compact('totalkamar', 'totalkamartersedia', 'totalkamarkotor','total_pendapatan')
        );
    }
}
