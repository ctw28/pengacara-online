<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\MBayarKategori;
use App\Models\MasterSatuan;
use App\Models\MKegiatanJabatan;
use App\Models\KegiatanJabatan;
use App\Models\KegiatanBayarJabatan;
use App\Models\KegiatanBayarJabatanAtur;
use App\Models\KegiatanPeserta;
use App\Models\KegiatanPembayaran;
use App\Models\KegiatanPembayaranSesi;
use App\Models\KegiatanPesertaBayar;
use App\Models\TahunAnggaranDipa;
use App\Models\PengaturanFakultas;
use App\Models\TahunAnggaranPengaturan;
use Illuminate\Support\Facades\Http;

class KegiatanController extends Controller
{
    public function index(){
        $data['title']          = "Daftar Kegiatan";
        $data['dataKegiatan']   = Kegiatan::all();
        return view('user.kegiatan-index',[
            "data"=>$data,
        ]);
    }
    public function create(){
        $data['title'] = "Tambah Kegiatan";
        return view('user.kegiatan-create',[
            "data"=>$data,
        ]);
    }
    public function edit($kegiatanId){
        $data['title'] = "Edit Kegiatan";
        $data['kegiatan'] = Kegiatan::find($kegiatanId);
        return view('user.kegiatan-edit',[
            "data"=>$data,
        ]);
    }
    public function update(Request $request, $kegiatanId){
        try {
            //code...
            $data = [
                'kegiatan_nama'=>$request->kegiatan_nama,
                'kegiatan_tanggal'=>$request->kegiatan_tanggal,
                'kegiatan_sub_kegiatan'=>$request->kegiatan_sub_kegiatan,
                'kegiatan_akun'=>$request->kegiatan_akun,
                'kegiatan_nomor_bukti'=>$request->kegiatan_nomor_bukti,
                'kegiatan_sk'=>$request->kegiatan_sk,
                'kegiatan_sk_tanggal'=>$request->kegiatan_sk_tanggal,
            ];
            // return $data;
            $kegiatan = Kegiatan::find($kegiatanId);
            $kegiatan->update($data);
            return redirect()->route('user.kegiatan.index');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($kegiatanId){
        $find = Kegiatan::find($kegiatanId);
        $find->delete();
        return redirect()->back(); 
    }

    public function store(Request $request){
        $request->pengaturan_fakultas_id = session('sesi')['pengaturan_fakultas_id'];
        $data = [
            'pengaturan_fakultas_id'=>session('sesi')['pengaturan_fakultas_id'],
            'kegiatan_nama'=>$request->kegiatan_nama,
            'kegiatan_tanggal'=>$request->kegiatan_tanggal,
            'kegiatan_sub_kegiatan'=>$request->kegiatan_sub_kegiatan,
            'kegiatan_akun'=>$request->kegiatan_akun,
            'kegiatan_nomor_bukti'=>$request->kegiatan_no_bukti,
            'kegiatan_sk'=>$request->kegiatan_sk,
            'kegiatan_sk_tanggal'=>$request->kegiatan_sk_tanggal,
        ];
        $kegiatan = Kegiatan::create($data);
        return redirect()->route('user.kegiatan.index');
    }
    
    public function storeJabatan(Request $request){
        $data = [
            'kegiatan_id'=>$request->kegiatan_id,
            'm_kegiatan_jabatan_id'=>$request->m_kegiatan_jabatan_id,
        ];
        $kegiatan = KegiatanJabatan::create($data);
        return redirect()->back();
    }

    public function destroyJabatan($id){
        $data = KegiatanJabatan::find($id);
        $data->delete();
        return redirect()->back();
    }

    public function setup($id){
        $data['title']                  = "Atur Kegiatan";
        $data['kegiatan']               = Kegiatan::find($id);        
        $data['kegiatanJabatanData']    = KegiatanJabatan::with(['mKegiatanJabatan'])->where('kegiatan_id',$id)->get();
        $data['kegiatanJabatan']        = MKegiatanJabatan::all();
        // return $data;
        return view('user.kegiatan-setup',[
            "data"=>$data,
        ]);
    }
    
    public function setupJabatanBayar($id, $kegiatanJabatanId){
        $data['title']                      = "Pengaturan Pembayaran Jabatan";
        $data['kegiatan']                   = Kegiatan::find($id);
        $data['kegiatanJabatan']            = KegiatanJabatan::with(['mKegiatanJabatan'])->find($kegiatanJabatanId);
        $data['bayarKategori']              = MBayarKategori::all();
        $data['satuan']                     = MasterSatuan::all();
        $data['kegiatanBayarJabatanData']   = KegiatanBayarJabatan::with(['kegiatanBayarJabatanAtur'=>function($kegiatanBayarJabatanAtur){
            $kegiatanBayarJabatanAtur->with(['masterSatuan']);
        },'mBayarKategori'])->where('kegiatan_jabatan_id',$kegiatanJabatanId)->get();
        // return $data;
        return view('user.kegiatan-jabatan-bayar-setup',[
            "data"=>$data,
        ]);
    }

    public function storeSetupJabatanBayar(Request $request){
        $kegiatanJabatanData = [
            'kegiatan_jabatan_id'=>$request->kegiatan_jabatan_id,
            'm_bayar_kategori_id'=>$request->m_bayar_kategori_id,
        ];
        $kegiatanJabatan    = KegiatanBayarJabatan::create($kegiatanJabatanData);
        $kegiatanJabatanId  = $kegiatanJabatan->id;
        $kegiatanBayarJabatanAturData = [
            'kegiatan_bayar_jabatan_id'=> $kegiatanJabatanId,
            'honor'=> preg_replace('/[^0-9]/', '', $request->honor),
            'jumlah'=> $request->jumlah,
            'master_satuan_id'=> $request->master_satuan_id,
        ];
        $kegiatanBayarJabatanAtur = KegiatanBayarJabatanAtur::create($kegiatanBayarJabatanAturData);
        return redirect()->back();        
    }

    public function destroySetupJabatanBayar($id){
        $find = KegiatanBayarJabatan::find($id);
        $find->delete();
        return redirect()->back();        
    }

    public function aturJabatanPesertaList($id, $kegiatanJabatanId){
        $data['title']              = "Pengaturan Peserta";
        $data['kegiatan']           = Kegiatan::find($id);
        $data['kegiatanJabatan']    = KegiatanJabatan::with(['mKegiatanJabatan'])->find($kegiatanJabatanId);
        $data['dataPeserta']        = KegiatanPeserta::where('kegiatan_jabatan_id',$kegiatanJabatanId)->get();
        // return $data;
        return view('user.kegiatan-jabatan-peserta-list',[
            "data"=>$data,
        ]);     
    }
    public function aturJabatanPesertaAdd($id, $kegiatanJabatanId){
        $data['title']              = "Pengaturan Peserta";
        $data['kegiatan']           = Kegiatan::find($id);
        $data['kegiatanJabatan']    = KegiatanJabatan::with(['mKegiatanJabatan'])->find($kegiatanJabatanId);
        $data['dataPeserta']        = KegiatanPeserta::where('kegiatan_jabatan_id',$kegiatanJabatanId)->get();
        // return $data;
        return view('user.kegiatan-jabatan-peserta-tambah',[
            "data"=>$data,
        ]);     
    }

    public function storeSetupJabatanPeserta(Request $request){
        try {
            $save = KegiatanPeserta::create([
                'idpeg' => $request->idpeg,
                'kegiatan_jabatan_id' => $request->kegiatan_jabatan_id,
                'nip' => $request->nip,
                'nama' => $request->nama,
                'golongan' => $request->golongan,
                'pajak' => $request->pajak,
                'is_iain' => $request->is_iain,
            ]);
            return array("status"=>true);
            //code...
        } catch (\Throwable $th) {
            // throw $th;
            return array("status"=>false);
        }
    }
    
    
    public function destroySetupJabatanPeserta(Request $request){
        try {
            $data = KegiatanPeserta::where([
                'idpeg' => $request->idpeg,
                'kegiatan_jabatan_id' => $request->kegiatan_jabatan_id,
            ]);
            $data->delete();
            return array("status"=>true);
            //code...
        } catch (\Throwable $th) {
            //throw $th;
            return array("status"=>false);
        }
    }

    //ini api untuk dapat peserta per kegiatan jabatan
    public function getSetupJabatanPeserta($kegiatanJabatanId){
        try {
            $data = KegiatanPeserta::where('kegiatan_jabatan_id',$kegiatanJabatanId)->get();
            return array("status"=>true,"data"=>$data);
        } catch (\Throwable $th) {
            //throw $th;
            return array("status"=>false,"data"=>[]);
        }
    }

    public function bayarKegiatan($id){
        $data['title']      = "Pembayaran";
        $data['kegiatan']   = Kegiatan::find($id);
        $data['pembayaran'] = KegiatanPembayaran::with('kegiatanPeserta')->where('kegiatan_id',$id)->get();
        $data['peserta']    = KegiatanPeserta::whereHas('kegiatanJabatan', function($kegiatanJabatan) use ($id){
                                  $kegiatanJabatan->where('kegiatan_id',$id);
                              })->get();

        // return $data;
        return view('user.kegiatan-pembayaran',[
            "data"=>$data,
        ]);    

    }


    //api untuk dapat data peserta
    public function getKegiatanPeserta($id){ //ini untuk dapat semua peserta per kegiatan
        $data = KegiatanPeserta::whereHas('kegiatanJabatan', function($kegiatanJabatan) use ($id){
            $kegiatanJabatan->where('kegiatan_id',$id);
        })->get();
        return $data;
    }
    
    public function getPesertaPerSesiPembayaran($pembayaranSesiId){ //untuk dapat peserta per sesi pembayaran
        $data['peserta'] = KegiatanPeserta::whereHas('kegiatanJabatan', function($kegiatanJabatan) use ($pembayaranSesiId){
            $kegiatanJabatan->wherehas('kegiatanBayarJabatan',function($kegiatanBayarJabatan) use ($pembayaranSesiId){
                $kegiatanBayarJabatan->wherehas('kegiatanPembayaranSesi', function($kegiatanPembayaranSesi) use ($pembayaranSesiId){
                    $kegiatanPembayaranSesi->where('id',$pembayaranSesiId);
                });
            });
        })->get();
        return $data;
    }

    public function getKegiatanPesertaJenisPembayaran($id){ //ini untuk dapat semua peserta per kegiatan
        $data = KegiatanPeserta::whereHas('kegiatanJabatan', function($kegiatanJabatan) use ($id){
            $kegiatanJabatan->where('kegiatan_id',$id);
        })->get();
        return $data;
    }

    public function getPeserta(Request $request){ //ini untuk dapat 1 peserta saja
        $data = KegiatanPeserta::find($request->id);
        return $data;
    }
    
    public function getPenerima($kegiatanId){ //ini untuk ambil daftar penerima
        $data = KegiatanPembayaran::with('kegiatanPeserta')->where('kegiatan_id', $kegiatanId)->get();
        return $data;
    }


    public function storebayarKegiatan(Request $request){
        try {
            $kegiatanId = $request->kegiatan_id;
            $pesertaId = KegiatanPeserta::whereHas('kegiatanJabatan',function($kegiatanJabatan) use ($kegiatanId){
                $kegiatanJabatan->where('kegiatan_id',$kegiatanId);
            })->where('idpeg',$request->kegiatan_peserta_id)->first();
            $save = KegiatanPembayaran::create([
                'kegiatan_id' => $kegiatanId,
                'kegiatan_peserta_id' => $pesertaId->id,
                'kegiatan_pembayaran_tanggal' => $request->kegiatan_pembayaran_tanggal,
                'kegiatan_pembayaran_tanggal_lunas' => $request->kegiatan_pembayaran_tanggal_lunas,
            ]);
            return redirect()->back();
            //code...
        } catch (\Throwable $th) {
            throw $th;
            // return array("status"=>false);
        }
    }
    public function destroyBayarKegiatan($id){
        try {
            $find = KegiatanPembayaran::find($id);
            $find->delete();
            return redirect()->back(); 
            //code...
        } catch (\Throwable $th) {
            throw $th;
            // return array("status"=>false);
        }
    }
    
    
    public function indexAmpra($kegiatanId, $pembayaranId){
        // return $pembayaranId;
        $data['title']      = "Pembayaran Ampra";
        $data['kegiatan']   = Kegiatan::find($kegiatanId);
        $data['pembayaran'] = KegiatanPembayaran::find($pembayaranId);
        $data['pembayaranSesi'] = KegiatanPembayaranSesi::with(['kegiatanBayarJabatan' => function($kegiatanBayarJabatan){
            $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanBayarJabatanAtur'=>function($kegiatanBayarJabatanAtur){
                $kegiatanBayarJabatanAtur->with('masterSatuan');
            },'kegiatanJabatan' => function($KegiatanJabatan){
                $KegiatanJabatan->with('mKegiatanJabatan');
            }]);
        }])->where('pembayaran_id',$pembayaranId)->get();

        $data['bayarJabatan'] = KegiatanJabatan::with(['kegiatanBayarJabatan' => function($kegiatanBayarJabatan){
            $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanBayarJabatanAtur'=>function($kegiatanBayarJabatanAtur){
                $kegiatanBayarJabatanAtur->with('masterSatuan');
            }]);
        },'mKegiatanJabatan'])->where('kegiatan_id',$kegiatanId)->get();
        // return $data;
        return view('user.kegiatan-ampra-index',[
            "data"=>$data,
        ]);   
    }
    public function addAmpra(Request $request, $kegiatanId, $pembayaranId){
        try {
            $listKegiatanBayarId = [];

            foreach ($request->kegiatan_bayar_jabatan_id as $index=> $row){
                $listKegiatanBayarId[$index]['pembayaran_id'] = $pembayaranId;
                $listKegiatanBayarId[$index]['kegiatan_bayar_jabatan_id'] = $row;
            }
            // return $listKegiatanBayarId;
            $save = KegiatanPembayaranSesi::insert($listKegiatanBayarId);
            // return $save;
            return redirect()->back();
        } catch (\Throwable $th) {
            throw $th;
            // return
        }
    }
    
    public function destroyAmpra($id){
        try {
            $find = KegiatanPembayaranSesi::find($id);
            $find->delete();
            return redirect()->back(); 
        } catch (\Throwable $th) {
            throw $th;
            // return
        }
    }

    public function storeAmpra(Request $request){
        try {
        $check = KegiatanPesertaBayar::where('kegiatan_pembayaran_sesi_id',$request->kegiatan_pembayaran_sesi_id)->get();
        if(count($check)>0){
            $check->each(function ($data) {
                $data->delete();
            });
        }
        // return $check;
        $data = json_decode($request->data);
        $dataInsert = [];
        foreach($data as $key => $row){
            $dataInsert[$key]['kegiatan_pembayaran_sesi_id'] = $request->kegiatan_pembayaran_sesi_id;
            $dataInsert[$key]['kegiatan_peserta_id'] = $row->kegiatan_peserta_id;
            $dataInsert[$key]['honor'] = $row->honor;
            $dataInsert[$key]['master_satuan_id'] = $row->master_satuan_id;
            $dataInsert[$key]['jumlah'] = $row->jumlah;
            $dataInsert[$key]['pajak'] = $row->pajak;
        }
        // return $dataInsert;
        $save = KegiatanPesertaBayar::insert($dataInsert);
        return array("status"=>true);
        } catch (\Throwable $th) {
            throw $th;
            // return
        }
        // return redirect()->back();
    }
    public function setAmpra($kegiatanId, $pembayaranId, $pembayaranSesiId){
        $data['title']      = "Pembayaran Ampra";
        $data['kegiatan']   = Kegiatan::find($kegiatanId);
        $data['pembayaran'] = KegiatanPembayaran::find($pembayaranId);
        
        $honor = KegiatanBayarJabatanAtur::whereHas('kegiatanBayarJabatan', function ($kegiatanBayarJabatan) use ($pembayaranSesiId){
            $kegiatanBayarJabatan->whereHas('kegiatanPembayaranSesi', function ($kegiatanPembayaranSesi) use ($pembayaranSesiId){
                $kegiatanPembayaranSesi->where('id',$pembayaranSesiId);
            });
        })->with(['kegiatanBayarJabatan'=>function($kegiatanBayarJabatan){
            $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanJabatan'=>function($kegiatanJabatan){
                $kegiatanJabatan->with(['mKegiatanJabatan']);
            }]);
        },'masterSatuan'])->get();
        // return $peserta;
        
        $check = KegiatanPesertaBayar::where('kegiatan_pembayaran_sesi_id',$pembayaranSesiId)->count();
        if($check>0){
            $peserta = KegiatanPesertaBayar::with(['kegiatanPeserta','kegiatanPembayaranSesi'=>function($kegiatanPembayaranSesi){
                $kegiatanPembayaranSesi->with(['kegiatanBayarJabatan'=> function($kegiatanBayarJabatan){
                    $kegiatanBayarJabatan->with(['kegiatanJabatan'=>function($kegiatanJabatan){
                        $kegiatanJabatan->with('mKegiatanJabatan');
                    }]);
                }]);
            }])->where('kegiatan_pembayaran_sesi_id',$pembayaranSesiId)->get();
            if($honor[0]->kegiatanBayarJabatan->mBayarKategori->is_pajak==1){
            $data['pajak']=true;
            $peserta->map(function($data) use ($honor){
                $data->id = $data->kegiatan_peserta_id;
                $data->nama = $data->kegiatanPeserta->nama;
                $data->golongan = $data->kegiatanPeserta->golongan;
                $data->honor = $data->honor;
                $data->jumlah = $data->jumlah;
                $data->jabatan = $data->kegiatanPembayaranSesi->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama;
                $data->total = $data->honor * $data->jumlah;
                $data->pajak = $data->kegiatanPeserta->pajak;
                $data->pajak_potong = ($data->pajak/100 * $data->honor * $data->jumlah);
                $data->terima = $data->total- $data->pajak_potong ;
            });
        }
        else{
            $data['pajak']=false;
            $peserta->map(function($data) use ($honor){
                                $data->id = $data->kegiatan_peserta_id;

                $data->nama = $data->kegiatanPeserta->nama;
                $data->golongan = $data->kegiatanPeserta->golongan;
                $data->honor = $data->honor;
                $data->pajak = $data->kegiatanPeserta->pajak;
                $data->jumlah = $data->jumlah;
                $data->jabatan = $data->kegiatanPembayaranSesi->kegiatanBayarJabatan->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama;
                $data->total = $data->honor * $data->jumlah;
                $data->pajak_potong = 0;
                $data->terima = $data->total;
            });
        }
        }
        else{
            $peserta = KegiatanPeserta::whereHas('kegiatanJabatan', function($kegiatanJabatan) use ($pembayaranSesiId){
                $kegiatanJabatan->wherehas('kegiatanBayarJabatan',function($kegiatanBayarJabatan) use ($pembayaranSesiId){
                    $kegiatanBayarJabatan->wherehas('kegiatanPembayaranSesi', function($kegiatanPembayaranSesi) use ($pembayaranSesiId){
                        $kegiatanPembayaranSesi->where('id',$pembayaranSesiId);
                    });
                });
            })->get();
            if($honor[0]->kegiatanBayarJabatan->mBayarKategori->is_pajak==1){
                $data['pajak']=true;
                $peserta->map(function($data) use ($honor){
                    $data->honor = $honor[0]->honor;
                    $data->jumlah = $honor[0]->jumlah;
                    $data->jabatan = $data->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama;
                    $data->total = $honor[0]->honor * $honor[0]->jumlah;
                    $data->pajak_potong = ($data->pajak/100 * $honor[0]->honor * $honor[0]->jumlah);
                    $data->terima = $data->total- $data->pajak_potong ;
                });
            }
            else{
                $data['pajak']=false;
                $peserta->map(function($data) use ($honor){
                    $data->honor = $honor[0]->honor;
                    $data->jumlah = $honor[0]->jumlah;
                    $data->jabatan = $data->kegiatanJabatan->mKegiatanJabatan->kegiatan_jabatan_nama;
                    $data->total = $honor[0]->honor * $honor[0]->jumlah;
                    $data->pajak_potong = 0;
                    $data->terima = $data->total;
                });
            }

        }
        $total = $peserta->reduce(function($tot, $item){
            return $tot + $item->terima;
        },0);
        
        $data['total'] = $total;
        $data['pembayaranJenis'] = $honor[0];
        $data['peserta'] = $peserta;
        $data['sesiId'] = $pembayaranSesiId;
        // return $data;
        return view('user.kegiatan-ampra-set',[
            "data"=>$data,
        ]);   
    }


    public function cetak($kegiatanId, $pembayaranId){
        $data['title'] = "List Cetak";
        $data['kegiatan']   = Kegiatan::find($kegiatanId);
        $data['pembayaran'] = KegiatanPembayaran::find($pembayaranId);
        $data['pembayaranSesi'] = KegiatanPembayaranSesi::with(['kegiatanBayarJabatan' => function($kegiatanBayarJabatan){
            $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanBayarJabatanAtur'=>function($kegiatanBayarJabatanAtur){
                $kegiatanBayarJabatanAtur->with('masterSatuan');
            },'kegiatanJabatan' => function($KegiatanJabatan){
                $KegiatanJabatan->with('mKegiatanJabatan');
            }]);
        }])->where('pembayaran_id',$pembayaranId)->get();

        $data['bayarJabatan'] = KegiatanJabatan::with(['kegiatanBayarJabatan' => function($kegiatanBayarJabatan){
            $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanBayarJabatanAtur'=>function($kegiatanBayarJabatanAtur){
                $kegiatanBayarJabatanAtur->with('masterSatuan');
            }]);
        },'mKegiatanJabatan'])->where('kegiatan_id',$kegiatanId)->get();

        $data['listDokumen'] = [
            ['nama'=>"Kwitansi", 'alias'=>'kwitansi'],
            ['nama'=>"Rekap", 'alias'=>'rekap'],
            ['nama'=>"Surat Pernyataan Tanggung Jawab Belanja", 'alias'=>'sptjb'],
            ['nama'=>"Surat Setoran Pajak", 'alias'=>'ssp'],
            ['nama'=>"Permohonan Pemerikansaan Berkas Pencarian Anggaran", 'alias'=>'ppbpa'],
            ['nama'=>"Lembar Permohonan Penerbitan SPM", 'alias'=>'spm'],
        ];
        // return $data;
        return view('user.cetak.cetak-list',[
            "data"=>$data,
        ]); 
    }

    public function penyebut($nilai) {
		$nilai = abs($nilai);
		$huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
		$temp = "";
		if ($nilai < 12) {
			$temp = " ". $huruf[$nilai];
		} else if ($nilai <20) {
			$temp =  $this->penyebut($nilai - 10). " belas";
		} else if ($nilai < 100) {
			$temp =  $this->penyebut($nilai/10)." puluh".  $this->penyebut($nilai % 10);
		} else if ($nilai < 200) {
			$temp = " seratus" .  $this->penyebut($nilai - 100);
		} else if ($nilai < 1000) {
			$temp =  $this->penyebut($nilai/100) . " ratus" .  $this->penyebut($nilai % 100);
		} else if ($nilai < 2000) {
			$temp = " seribu" .  $this->penyebut($nilai - 1000);
		} else if ($nilai < 1000000) {
			$temp =  $this->penyebut($nilai/1000) . " ribu" .  $this->penyebut($nilai % 1000);
		} else if ($nilai < 1000000000) {
			$temp =  $this->penyebut($nilai/1000000) . " juta" .  $this->penyebut($nilai % 1000000);
		} else if ($nilai < 1000000000000) {
			$temp =  $this->penyebut($nilai/1000000000) . " milyar" .  $this->penyebut(fmod($nilai,1000000000));
		} else if ($nilai < 1000000000000000) {
			$temp =  $this->penyebut($nilai/1000000000000) . " trilyun" .  $this->penyebut(fmod($nilai,1000000000000));
		}     
		return $temp;
	}
 
	function terbilang($nilai) {
		if($nilai<0) {
			$hasil = "minus ". trim($this->penyebut($nilai));
		} else {
			$hasil = trim($this->penyebut($nilai));
		}     		
		return $hasil;
	}
    
    public function cetakDokumen($kegiatanId, $pembayaranId, $alias){
            // return session('sesi');
            $data['ppk'] = PengaturanFakultas::with(['pengaturanJabatan'=>function($pengaturanJabatan){
                $pengaturanJabatan->with('masterJabatan');
            }])->where('id',session('sesi')['pengaturan_fakultas_id'])->first();
            $data['bendaharaPengeluaran'] = TahunAnggaranPengaturan::where('id',session('sesi')['tahun_anggaran_pengaturan_id'])->with(['pengaturanJabatan'=>function($pengaturanJabatan){
                $pengaturanJabatan->with('masterJabatan');
            }])->first();
            // $data['kegiatanPembayaran'] = KegiatanPembayaran::with(['kegiatan'])->where('')->get();
            $data['kegiatan'] = Kegiatan::whereHas('kegiatanPembayaran', function($kegiatanPembayaran) use($pembayaranId){
                $kegiatanPembayaran->where('id',$pembayaranId);
            })->with(['kegiatanPembayaran'=>function($kegiatanPembayaran) use($pembayaranId){
                $kegiatanPembayaran->with(['kegiatanPembayaranSesi'=>function($kegiatanPembayaranSesi) use($pembayaranId){
                    $kegiatanPembayaranSesi->with(['kegiatanPesertaBayar'=>function($kegiatanPesertaBayar){
                        $kegiatanPesertaBayar->select(['kegiatan_pembayaran_sesi_id','honor','jumlah','pajak']);
                    },'kegiatanBayarJabatan'=>function($kegiatanBayarJabatan){
                        $kegiatanBayarJabatan->with(['kegiatanJabatan'=>function($kegiatanJabatan){
                            $kegiatanJabatan->with('mKegiatanJabatan');
                        },'mBayarKategori']);
                    }]);
                },'kegiatanPeserta'])->where('id',$pembayaranId);
            }])->where('id',$kegiatanId)->get();
            $bayar = $data['kegiatan'][0]->kegiatanPembayaran[0]->kegiatanPembayaranSesi;
            $bayar->map(function($data) {
                $data->total = 
                $data->kegiatanPesertaBayar->reduce(function($tot, $item){
                    return $tot + ($item->honor*$item->jumlah);
                },0);
                $data->pajak = 
                $data->kegiatanPesertaBayar->reduce(function($tot, $item){
                    return $tot + $item->pajak;
                },0);
            });
            $total = $bayar->reduce(function($tot, $item){
                return $tot + $item->total;
            },0);
            $pajak = $bayar->reduce(function($tot, $item){
                return $tot + $item->pajak;
            },0);
            // $pajak = $bayar[0]->kegiatanPesertaBayar->reduce(function($tot, $item){
            //     return $tot + $item->pajak;
            // },0);
            $data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan = $total;
            $data['kegiatan'][0]->kegiatanPembayaran[0]->total_terima = $total-$pajak;
            $data['kegiatan'][0]->kegiatanPembayaran[0]->pajak = $pajak;
            $data['kegiatan'][0]->kegiatanPembayaran[0]->terbilang = $this->terbilang($data['kegiatan'][0]->kegiatanPembayaran[0]->total_keseluruhan);
            $data['kegiatan'][0]->kegiatanPembayaran[0]->terbilang_pajak = $this->terbilang($data['kegiatan'][0]->kegiatanPembayaran[0]->pajak);

            // return $data;
        if($alias=='kwitansi'){
            return view('user.cetak.kwitansi',[
                "data"=>$data,
            ]); 
        }
        else if($alias=='rekap'){
            return view('user.cetak.rekap',[
                "data"=>$data,
            ]); 
        }
        else if($alias=='sptjb'){
            $tahunAnggaranId = session('sesi')['tahun_anggaran_id'];
            $data['dipa'] = TahunAnggaranDipa::where('tahun_anggaran_id',$tahunAnggaranId)->first();
            return view('user.cetak.sptjb',[
                "data"=>$data,
            ]); 
        }
        else if($alias=='ppbpa'){
            return view('user.cetak.permohonan_pemeriksaan_berkas',[
                "data"=>$data,
            ]); 
        }
        else if($alias=='ssp'){
            return view('user.cetak.ssp',[
                "data"=>$data,
            ]); 
        }
        else if($alias=='spm'){
            return view('user.cetak.spm',[
                "data"=>$data,
            ]); 
        }
    }

    public function printAmpra($kegiatanId, $pembayaranId,$pembayaranSesiId){
        $data['kegiatan']   = Kegiatan::find($kegiatanId);
        $data['pembayaran'] = KegiatanPembayaran::find($pembayaranId);
        
        // $honor = KegiatanBayarJabatanAtur::whereHas('kegiatanBayarJabatan', function ($kegiatanBayarJabatan) use ($pembayaranSesiId){
        //     $kegiatanBayarJabatan->whereHas('kegiatanPembayaranSesi', function ($kegiatanPembayaranSesi) use ($pembayaranSesiId){
        //         $kegiatanPembayaranSesi->where('id',$pembayaranSesiId);
        //     });
        // })->with('kegiatanBayarJabatan',function($kegiatanBayarJabatan){
        //     $kegiatanBayarJabatan->with(['mBayarKategori','kegiatanJabatan'=>function($kegiatanJabatan){
        //         $kegiatanJabatan->with(['mKegiatanJabatan']);
        //     }]);
        // },'masterSatuan')->first();

        $data['dataPembayaran'] = KegiatanBayarJabatan::whereHas('kegiatanPembayaranSesi',function($kegiatanPembayaranSesi) use ($pembayaranSesiId){
            $kegiatanPembayaranSesi->where('id',$pembayaranSesiId);
        })->with(['kegiatanPembayaranSesi'=>function($kegiatanPembayaranSesi){
            $kegiatanPembayaranSesi->with(['kegiatanPesertaBayar'=>function($kegiatanPesertaBayar){
                $kegiatanPesertaBayar->with(['kegiatanPeserta','masterSatuan']);
            }]);
        },'kegiatanJabatan'=>function($kegiatanJabatan){
            $kegiatanJabatan->with('mKegiatanJabatan');
        },'mBayarKategori'])->get();
        
        $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->map(function($data) {
            $data->total = $data->honor * $data->jumlah;
        });

        

        // if($honor[0]->kegiatanBayarJabatan->mBayarKategori->is_pajak==1){
        //     $data['pajak']=true;
        //     $peserta->map(function($data) use ($honor){
        //         $data->total = $honor[0]->honor * $honor[0]->jumlah;
        //         $data->pajak = ($data->pajak/100 * $honor[0]->honor * $honor[0]->jumlah);
        //         $data->terima = $data->total- $data->pajak ;
        //     });
        // }
        // else{
        //     $data['pajak']=false;
        //     $peserta->map(function($data) use ($honor){
        //         $data->total = $honor[0]->honor * $honor[0]->jumlah;
        //         $data->pajak = 0;
        //         $data->terima = $data->total;
        //     });
        // }
        // $total = $peserta->reduce(function($tot, $item){
        //     return $tot + $item->terima;
        // },0);
        if($data['dataPembayaran'][0]->mBayarKategori->is_pajak==1){
            $data['pajak']=true;
            $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->map(function($data){
                $data->terima = $data->honor * $data->jumlah - $data->pajak ;
            });
        }
        else{
            $data['pajak']=false;
            $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->map(function($data){
                $data->terima = $data->honor * $data->jumlah;
            });
        }
        
        $totalTerima = $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->reduce(function($tot, $item){
            return $tot + $item->terima;
        },0); 
        $totalPajak = $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->reduce(function($tot, $item){
            return $tot + $item->pajak;
        },0); 
        $total = $data['dataPembayaran'][0]->kegiatanPembayaranSesi->kegiatanPesertaBayar->reduce(function($tot, $item){
            return $tot + $item->total;
        },0); 

        $data['totalPajak'] = $totalPajak;
        $data['totalTerima'] = $totalTerima;
        $data['total'] = $total;
        $data['sesiId'] = $pembayaranSesiId;
        // return $data;
        return view('user.cetak.ampra',[
            "data"=>$data,
        ]);  
    }


}