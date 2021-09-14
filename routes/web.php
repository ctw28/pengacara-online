<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TahunAnggaranController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\User\KegiatanController;
use App\Http\Controllers\User\DashboardController as DashboardUserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function(){
    Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/tahun-anggaran', [TahunAnggaranController::class, 'index'])->name('admin.tahun.anggaran');
        Route::get('/tahun-anggaran/tambah', [TahunAnggaranController::class, 'create'])->name('admin.tahun.anggaran.tambah');
        Route::post('/tahun-anggaran/simpan', [TahunAnggaranController::class, 'store'])->name('admin.tahun.anggaran.simpan');
        Route::get('/tahun-anggaran/{id}/atur-fakultas', [TahunAnggaranController::class, 'atur_fakultas'])->name('admin.set.fakultas');
    });

    Route::group(['prefix' => 'user','middleware'=>'user'], function () {
        Route::get('/pilih-tahun-anggaran', [DashboardUserController::class, 'choose'])->name('user.choose.tahun.anggaran');
        Route::post('/set-tahun-anggaran', [DashboardUserController::class, 'set'])->name('user.set.tahun.anggaran');
        Route::group(['middleware'=>'user-sesi'], function () {
            Route::get('/sesi', [DashboardUserController::class, 'lihat_sesi_data'])->name('user.sesi'); //untuk membantu melihat data sesi
            Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
            Route::get('/kwitansi', [CetakController::class, 'index'])->name('kwitansi');
            Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('user.kegiatan.index');
            Route::get('/kegiatan/tambah', [KegiatanController::class, 'create'])->name('user.kegiatan.create');
            Route::post('/kegiatan/simpan', [KegiatanController::class, 'store'])->name('user.kegiatan.store');
            Route::get('/kegiatan/{id}/atur', [KegiatanController::class, 'setup'])->name('user.kegiatan.setup');
            Route::post('/kegiatan/atur/simpan-jabatan', [KegiatanController::class, 'storeJabatan'])->name('user.kegiatan.jabatan.store');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/setup', [KegiatanController::class, 'setupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup');
            Route::post('/kegiatan/atur/jabatan/setup/simpan', [KegiatanController::class, 'storeSetupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup.store');
            Route::get('/kegiatan/atur/jabatan/setup/{id}/hapus', [KegiatanController::class, 'destroySetupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup.destroy');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta', [KegiatanController::class, 'aturJabatanPesertaList'])->name('user.kegiatan.jabatan.peserta');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta/tambah', [KegiatanController::class, 'aturJabatanPesertaAdd'])->name('user.kegiatan.jabatan.peserta.add');

            // Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta/tambah/luar-iain', [KegiatanController::class, 'aturJabatanPesertaAddLuarIian'])->name('user.kegiatan.jabatan.peserta.add.luar');
            
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{idPembayaran}', [KegiatanController::class, 'indexAmpra'])->name('kegiatan.ampra.index');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/sesi-pembayaran/{pembayaranSesiId}', [KegiatanController::class, 'setAmpra'])->name('kegiatan.ampra.set');
            Route::post('/ampra/store', [KegiatanController::class, 'storeAmpra'])->name('kegiatan.ampra.store');
            Route::post('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/ampra/tambah', [KegiatanController::class, 'addAmpra'])->name('kegiatan.ampra.add');
            Route::get('/kegiatan/{id}/pembayaran', [KegiatanController::class, 'bayarKegiatan'])->name('user.kegiatan.bayar');
            Route::post('/kegiatan/{id}/pembayaran/simpan', [KegiatanController::class, 'storebayarKegiatan'])->name('user.kegiatan.bayar.store');
            
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak', [KegiatanController::class, 'cetak'])->name('kegiatan.print');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak/{pembayaranSesiId}/ampra', [KegiatanController::class, 'printAmpra'])->name('kegiatan.ampra.print');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak/dokumen/{alias}', [KegiatanController::class, 'cetakDokumen'])->name('kegiatan.print.dokumen');
        });
    });
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');