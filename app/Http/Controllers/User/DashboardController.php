<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MasterTahunAnggaran;
use App\Models\PengaturanFakultas;

class DashboardController extends Controller
{
    //
    public function choose(){
        if(session('sesi')!=null)
            return redirect()->route('user.dashboard');
        $tahunAnggaran = MasterTahunAnggaran::all();
        return view('user.pilih-tahun-anggaran',[
            'tahunAnggaran' => $tahunAnggaran
        ]);
    }
    public function set(Request $request){
        $tahunAnggaranID = $request->tahun_anggaran;
        $tahunAnggaran = PengaturanFakultas::with(['tahunAnggaranPengaturan'=>function($tahunAnggaranPengaturan) use ($tahunAnggaranID){
            $tahunAnggaranPengaturan->with(['tahunAnggaran'=>function($tahunAnggaran){
                $tahunAnggaran->select('id','tahun_anggaran','tahun_anggaran_sebutan');
            }])->select('id','tahun_anggaran_id','pengaturan_jabatan_id')->where('tahun_anggaran_id', $tahunAnggaranID);
        },'fakultas'])->where('master_fakultas_id',session('fakultas')->master_fakultas_id)->first();
        $sessionTahunAnggaran = [
            'pengaturan_fakultas_id'=> $tahunAnggaran->id,
            'tahun_anggaran_pengaturan_id'=> $tahunAnggaran->tahun_anggaran_pengaturan_id,
            'fakultas_id'=> $tahunAnggaran->master_fakultas_id,
            'fakultas_nama'=> $tahunAnggaran->fakultas->fakultas_nama,
            'fakultas_singkatan'=> $tahunAnggaran->fakultas->singkatan,
            'tahun_anggaran_id'=> $tahunAnggaran->tahunAnggaranPengaturan->tahun_anggaran_id,
            'tahun_anggaran'=> $tahunAnggaran->tahunAnggaranPengaturan->tahunAnggaran->tahun_anggaran,
            'tahun_anggaran_sebutan'=> $tahunAnggaran->tahunAnggaranPengaturan->tahunAnggaran->tahun_anggaran_sebutan,
        ];
        $request->session()->put('sesi', $sessionTahunAnggaran);
        // return $sessionTahunAnggaran;
        // return $tahunAnggaran;
        return redirect()->route('user.dashboard');
    }

    public function index(){
        $data['title'] = "Dashboard Fakultas";
        return view('user.dashboard',[
            "data"=>$data
        ]);
    }

    public function lihat_sesi_data(){
        return session('sesi');
    }
}