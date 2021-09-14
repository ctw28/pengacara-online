<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterFakultas;

class OtherController extends Controller
{
    //
    public function fakultas(){
        // return ;
        // $data['title'] = session('tahun_anggaran')->tahun_anggaran_sebutan;
        $data = MasterFakultas::all();
        return $data;
    }
}