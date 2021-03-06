<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TahunAnggaranController;
use App\Http\Controllers\CetakController;
use App\Http\Controllers\User\KegiatanController;
use App\Http\Controllers\User\DashboardController as DashboardUserController;
use App\Http\Controllers\User\RutinJabatanController;
use App\Http\Controllers\User\RutinSuratKeteranganController;
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

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/tahun-anggaran', [TahunAnggaranController::class, 'index'])->name('admin.tahun.anggaran');
        Route::get('/tahun-anggaran/tambah', [TahunAnggaranController::class, 'create'])->name('admin.tahun.anggaran.tambah');
        Route::post('/tahun-anggaran/simpan', [TahunAnggaranController::class, 'store'])->name('admin.tahun.anggaran.simpan');
        Route::get('/tahun-anggaran/{id}/atur-fakultas', [TahunAnggaranController::class, 'atur_fakultas'])->name('admin.set.fakultas');
    });

    Route::group(['prefix' => 'user', 'middleware' => 'user'], function () {
        Route::get('/pilih-tahun-anggaran', [DashboardUserController::class, 'choose'])->name('user.choose.tahun.anggaran');
        Route::post('/set-tahun-anggaran', [DashboardUserController::class, 'set'])->name('user.set.tahun.anggaran');
        Route::group(['middleware' => 'user-sesi'], function () {
            Route::get('/sesi', [DashboardUserController::class, 'lihat_sesi_data'])->name('user.sesi'); //untuk membantu melihat data sesi
            Route::get('/dashboard', [DashboardUserController::class, 'index'])->name('user.dashboard');
            Route::get('/kwitansi', [CetakController::class, 'index'])->name('kwitansi');
            Route::get('/kegiatan', [KegiatanController::class, 'index'])->name('user.kegiatan.index');
            Route::get('/kegiatan/tambah', [KegiatanController::class, 'create'])->name('user.kegiatan.create');
            Route::get('/kegiatan/{kegiatanId}/edit', [KegiatanController::class, 'edit'])->name('user.kegiatan.edit');
            Route::post('/kegiatan/{kegiatanId}/update', [KegiatanController::class, 'update'])->name('user.kegiatan.update');
            Route::post('/kegiatan/simpan', [KegiatanController::class, 'store'])->name('user.kegiatan.store');
            Route::get('/kegiatan/{kegiatanId}/hapus', [KegiatanController::class, 'delete'])->name('user.kegiatan.delete');
            Route::get('/kegiatan/{id}/atur', [KegiatanController::class, 'setup'])->name('user.kegiatan.setup');
            Route::post('/kegiatan/atur/simpan-jabatan', [KegiatanController::class, 'storeJabatan'])->name('user.kegiatan.jabatan.store');
            Route::get('/kegiatan/atur/jabatan/{id}', [KegiatanController::class, 'destroyJabatan'])->name('user.kegiatan.jabatan.destroy');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/setup', [KegiatanController::class, 'setupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup');
            Route::post('/kegiatan/atur/jabatan/setup/simpan', [KegiatanController::class, 'storeSetupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup.store');
            Route::get('/kegiatan/atur/jabatan/setup/{id}/hapus', [KegiatanController::class, 'destroySetupJabatanBayar'])->name('user.kegiatan.jabatan.bayar.setup.destroy');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta', [KegiatanController::class, 'aturJabatanPesertaList'])->name('user.kegiatan.jabatan.peserta');
            Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta/tambah', [KegiatanController::class, 'aturJabatanPesertaAdd'])->name('user.kegiatan.jabatan.peserta.add');

            // Route::get('/kegiatan/{id}/atur/jabatan/{kegiatanJabatanId}/peserta/tambah/luar-iain', [KegiatanController::class, 'aturJabatanPesertaAddLuarIian'])->name('user.kegiatan.jabatan.peserta.add.luar');

            Route::get('/kegiatan/{kegiatanId}/pembayaran/{idPembayaran}', [KegiatanController::class, 'indexAmpra'])->name('kegiatan.ampra.index');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/sesi-pembayaran/{pembayaranSesiId}', [KegiatanController::class, 'setAmpra'])->name('kegiatan.ampra.set');

            Route::post('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/ampra/tambah', [KegiatanController::class, 'addAmpra'])->name('kegiatan.ampra.add');
            Route::get('/kegiatan//pembayaran//pembayaran-sesi/{id}', [KegiatanController::class, 'destroyAmpra'])->name('kegiatan.ampra.destroy');
            Route::get('/kegiatan/{id}/pembayaran', [KegiatanController::class, 'bayarKegiatan'])->name('user.kegiatan.bayar');
            Route::post('/kegiatan/{id}/pembayaran/simpan', [KegiatanController::class, 'storebayarKegiatan'])->name('user.kegiatan.bayar.store');
            Route::get('/kegiatan/pembayaran/{id}/hapus', [KegiatanController::class, 'destroyBayarKegiatan'])->name('user.kegiatan.bayar.destroy');

            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak', [KegiatanController::class, 'cetak'])->name('kegiatan.print');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak/{pembayaranSesiId}/ampra', [KegiatanController::class, 'printAmpra'])->name('kegiatan.ampra.print');
            Route::get('/kegiatan/{kegiatanId}/pembayaran/{pembayaranId}/cetak/dokumen/{alias}', [KegiatanController::class, 'cetakDokumen'])->name('kegiatan.print.dokumen');

            //Rutin Jabatan Referensi
            Route::get('/referensi/master-jabatan', [RutinJabatanController::class, 'index'])->name('referensi.jabatan.index');
            Route::get('/referensi/master-jabatan/tambah', [RutinJabatanController::class, 'create'])->name('referensi.jabatan.create');
            Route::post('/referensi/master-jabatan/simpan', [RutinJabatanController::class, 'store'])->name('referensi.jabatan.store');
            Route::get('/referensi/master-jabatan/{id}/edit', [RutinJabatanController::class, 'edit'])->name('referensi.jabatan.edit');
            Route::post('/referensi/master-jabatan/{id}/update', [RutinJabatanController::class, 'update'])->name('referensi.jabatan.update');
            Route::get('/referensi/master-jabatan/{id}/hapus', [RutinJabatanController::class, 'delete'])->name('referensi.jabatan.delete');

            //Rutin Jabatan Referensi
            Route::get('/rutin/surat-keputusan', [RutinSuratKeteranganController::class, 'index'])->name('rutin.sk.index');
            Route::get('/rutin/surat-keputusan/tambah', [RutinSuratKeteranganController::class, 'create'])->name('rutin.sk.create');
            Route::post('/rutin/surat-keputusan/simpan', [RutinSuratKeteranganController::class, 'store'])->name('rutin.sk.store');
            Route::get('/rutin/surat-keputusan/{id}/edit', [RutinSuratKeteranganController::class, 'edit'])->name('rutin.sk.edit');
            Route::post('/rutin/surat-keputusan/{id}/update', [RutinSuratKeteranganController::class, 'update'])->name('rutin.sk.update');
            Route::get('/rutin/surat-keputusan/{id}/hapus', [RutinSuratKeteranganController::class, 'delete'])->name('rutin.sk.delete');

            Route::get('/rutin/surat-keputusan/{id}/atur', [RutinSuratKeteranganController::class, 'manage'])->name('rutin.sk.manage');
            Route::get('/rutin/surat-keputusan/{id}/atur/tambah', [RutinSuratKeteranganController::class, 'manageCreate'])->name('rutin.sk.manage.create');
        });
    });
});

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');