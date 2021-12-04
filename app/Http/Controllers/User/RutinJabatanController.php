<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RutinJabatan;


class RutinJabatanController extends Controller
{
    //
    public function index()
    {
        $data['title']          = "Referensi Jabatan";
        $data['dataMasterJabatan']   = RutinJabatan::all();
        return view('user.referensi.jabatan-index', [
            "data" => $data,
        ]);
    }
    public function create()
    {
        $data['title']          = "Tambah Referensi Jabatan";
        return view('user.referensi.jabatan-create', [
            "data" => $data,
        ]);
    }

    public function store(Request $request)
    {
        // return $request->all();
        try {
            //code...
            $data = [
                'pengaturan_fakultas_id' => session('sesi')['pengaturan_fakultas_id'],
                'jabatan_nama' => $request->jabatan_nama,
                'jabatan_keterangan' => $request->jabatan_keterangan,
            ];
            RutinJabatan::create($data);
            return redirect()->route('referensi.jabatan.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $data['title']          = "Edt Referensi Jabatan";
        $data['dataMasterJabatan'] = RutinJabatan::find($id);
        return view('user.referensi.jabatan-edit', [
            "data" => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        // return $request->all();
        try {
            $jabatan = RutinJabatan::find($id);
            $jabatan->jabatan_nama = $request->jabatan_nama;
            $jabatan->jabatan_keterangan = $request->jabatan_keterangan;
            $jabatan->save();
            return redirect()->route('referensi.jabatan.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $jabatan = RutinJabatan::find($id);
            $jabatan->delete();
            return redirect()->route('referensi.jabatan.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
