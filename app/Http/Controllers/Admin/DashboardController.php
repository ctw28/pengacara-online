<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    //
    public function index(){
        // return ;
        // $data['title'] = session('tahun_anggaran')->tahun_anggaran_sebutan;
        $data['title'] = "Dashboard Admin";
        return view('admin.dashboard',[
            "data"=>$data
        ]);
    }
}