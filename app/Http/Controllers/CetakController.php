<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CetakController extends Controller
{
    //
    public function index(){
        $data['title'] = "Kwitansi";
        return view('kwitansi',[
            "data"=>$data
        ]);
    }
}