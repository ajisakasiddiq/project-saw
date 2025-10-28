<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $data['sub'] = DB::table('sub')->get();
        $data['kriteria'] = DB::table('kriteria')->get();
        $data['mahasiswa'] = DB::table('mahasiswa')->get();
        $data['user'] = DB::table('users')->where('role', '!=', 'Admin')->get();
        $data['form'] = DB::table('form')->where('status', '=', '1')->get();
        return view('backend.index', $data);
    }

    public function about()
    {

        return view('backend.about');
    }
}
