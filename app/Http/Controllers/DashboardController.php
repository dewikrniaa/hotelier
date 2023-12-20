<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalkamar = DB::table('kamar')->count();

        // Pass all variables in a single array
        return view('layouts.dashboard', [
            'totalkamar' => $totalkamar,
        ]);
    }

}

