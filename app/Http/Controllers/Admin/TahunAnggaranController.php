<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TahunAnggaranPengaturan;
use App\Models\MasterTahunAnggaran;
use App\Models\TahunAnggaranDipa;
use App\Models\PengaturanJabatan;
use App\Models\MasterFakultas;
use App\Models\PengaturanFakultas;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;


class TahunAnggaranController extends Controller
{
    //
    public function index(){
        $data['title'] = "Pengaturan Tahun Anggaran";
        $data['dataTahunAnggaran'] = TahunAnggaranPengaturan::with(['tahunAnggaran'=>function($tahunAnggaran){
            $tahunAnggaran->with(['tahunAnggaranDipa'=>function($tahunAnggaranDipa){
                $tahunAnggaranDipa->select('id','tahun_anggaran_id','dipa_nomor','dipa_tgl');
            }])->select('id','tahun_anggaran','tahun_anggaran_sebutan');
        },'pengaturanJabatan'=> function($pengaturanJabatan){
            $pengaturanJabatan->select('id','master_jabatan_id','idpeg','is_aktif')->where('master_jabatan_id',1);
        }])->get();
        // $data['dataTahunAnggaran'] = TahunAnggaranPengaturan::with(['tahunAnggaran'=>function($tahunAnggaran){
        //     $tahunAnggaran->select('id','tahun','tahun_anggaran_nama');
        // },'pengaturanJabatan'=> function($pengaturanJabatan){
        //     $pengaturanJabatan->select('id','master_jabatan_id','idpeg','is_aktif')->where('master_jabatan_id',1);
        // }])->get();
        // return $data;
        return view('admin.tahun-anggaran',[
            "data"=>$data
        ]);
    }
    
    public function create(){
        $response = Http::withOptions(['verify' => false,])->get('https://simpeg.iainkendari.ac.id/api/juara/data-pegawai');
        // return $response->json();

        $data['title'] = "Tambah Tahun Anggaran";
        return view('admin.tahun-anggaran-create',[
            "data"=>$data,
            "pegawai"=>$response->json()
        ]);        
    }

    public function store(Request $request){
        try {
            DB::beginTransaction();

        $validated = $request->validate([
            'tahun_anggaran' => 'required',
            'tahun_anggaran_sebutan' => 'required'
        ]);

        $dataTahunAnggaran = [
            'tahun_anggaran'=> $request->tahun_anggaran,
            'tahun_anggaran_sebutan'=> $request->tahun_anggaran_sebutan
        ];
        
        $tahunAnggaran = MasterTahunAnggaran::create($dataTahunAnggaran);
        $tahunAnggaranId = $tahunAnggaran->id;
        $dataPejabat = [
            'idpeg'=> $request->idpeg,
            'is_aktif'=> $request->is_aktif,
            'keterangan'=> $request->keterangan,
            'master_jabatan_id'=> 1
        ];
        $pejabat = PengaturanJabatan::create($dataPejabat);
        $pejabatId = $pejabat->id;

        $dataDipa = [
            'tahun_anggaran_id'=> $tahunAnggaranId,
            'dipa_tgl'=> $request->dipa_tgl,
            'dipa_nomor'=> $request->dipa_nomor
        ];

        $dipa = TahunAnggaranDipa::create($dataDipa);
        $dataPengaturanTahunAnggaran = [
            'tahun_anggaran_id'=> $tahunAnggaranId,
            'pengaturan_jabatan_id'=> $pejabatId
        ];
        $pengaturanTahunAnggaran = TahunAnggaranPengaturan::create($dataPengaturanTahunAnggaran);
        
        DB::commit();
        return redirect()->route('admin.tahun.anggaran');

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;

        }
        // return $request->idpeg;
        

        

        // return redirect()->route('admin.tahun.anggaran')->with('message', \GeneralHelper::formatMessage('Berhasil menambahkan data !', 'success'));
    }

    public function atur_fakultas($id){
        
        $data['title'] = "Atur Fakultas";
        $data['dataFakultas'] = MasterFakultas::all();
        $data['dataPengaturanJabatanFakultas'] = PengaturanFakultas::with('pengaturanJabatan')->where('tahun_anggaran_pengaturan_id',$id)->get();
        $response = Http::withOptions(['verify' => false,])->get('https://simpeg.iainkendari.ac.id/api/juara/data-pegawai');
        // return $data;
        return view('admin.atur-fakultas',[
            "data"=>$data,
            "pegawai"=>$response->json()
        ]);   
    }

    public function save_pengaturan(Request $request){
        try {
            // $cek = PengaturanJabatan::where('master_fakultas_id',$request->master_fakultas_id)->count();
            // if($cek>0){
                
            // }
            DB::beginTransaction();
            $dataPejabat = [
                'idpeg'=> $request->idpeg,
                'is_aktif'=> 1,
                'keterangan'=> "",
                'master_jabatan_id'=> 2
            ];
            $pejabat = PengaturanJabatan::create($dataPejabat);
            $pejabatId = $pejabat->id;
            $dataPejabatFakultas = [
                'tahun_anggaran_pengaturan_id'=> $request->tahun_anggaran_pengaturan_id,
                'pengaturan_jabatan_id'=> $pejabatId,
                'master_fakultas_id'=> $request->master_fakultas_id
            ];
            
            $tahunAnggaran = PengaturanFakultas::create($dataPejabatFakultas);
            
            DB::commit();
            return array('status'=>"suksess");

        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;

        }
    }
}