<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\RutinSuratKeterangan;
use App\Models\RutinPejabat;
use App\Models\RutinJabatan;

class RutinSuratKeteranganController extends Controller
{
    //
    public function index()
    {
        $data['title']    = "Daftar Surat Keputusan";
        $data['dataSK']   = RutinSuratKeterangan::where('pengaturan_fakultas_id', session('sesi')['pengaturan_fakultas_id'])->get();
        return view('user.rutin.sk-index', [
            "data" => $data,
        ]);
    }
    public function create()
    {
        $data['title']          = "Tambah Surat Keputusan";
        return view('user.rutin.sk-create', [
            "data" => $data,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = [
                'pengaturan_fakultas_id' => session('sesi')['pengaturan_fakultas_id'],
                'sk' => $request->sk,
                'sk_tanggal' => $request->sk_tanggal,
                'sub_kegiatan' => $request->sub_kegiatan,
                'no_bukti' => $request->no_bukti,
                'akun' => $request->akun,
                'is_aktif' => $request->is_aktif,
            ];
            RutinSuratKeterangan::create($data);
            return redirect()->route('rutin.sk.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id)
    {
        $data['title']          = "Edit Surat Keputusan";
        $data['dataSK'] = RutinSuratKeterangan::find($id);
        return view('user.rutin.sk-edit', [
            "data" => $data,
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            $sk = RutinSuratKeterangan::find($id);
            $sk->sk = $request->sk;
            $sk->sub_kegiatan = $request->sub_kegiatan;
            $sk->no_bukti = $request->no_bukti;
            $sk->akun = $request->akun;
            $sk->is_aktif = $request->is_aktif;
            $sk->save();
            return redirect()->route('rutin.sk.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $sk = RutinSuratKeterangan::find($id);
            $sk->delete();
            return redirect()->route('rutin.sk.index');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function manage($id)
    {
        $data['title']          = "Atur Pejabat";
        $data['dataSK'] = RutinSuratKeterangan::find($id);
        $data['dataPejabat'] = RutinPejabat::where('rutin_surat_keterangan_id', $id);
        return view('user.rutin.sk-manage', [
            "data" => $data,
        ]);
    }

    public function manageCreate($id)
    {
        $data['title']          = "Tambah Pejabat";
        $data['dataSK'] = RutinSuratKeterangan::find($id);
        $data['masterJabatan'] = RutinJabatan::all();
        return view('user.rutin.sk-manage-create', [
            "data" => $data,
        ]);
    }
}
