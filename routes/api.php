<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OtherController;
use App\Http\Controllers\Admin\TahunAnggaranController;
use App\Http\Controllers\User\KegiatanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/pejabat-fakultas/simpan', [TahunAnggaranController::class, 'save_pengaturan'])->name('admin.save.pejabat.fakultas');
Route::get('/master-fakultas', [OtherController::class, 'fakultas'])->name('api.fakultas');
Route::post('/kegiatan/atur/jabatan/peserta/simpan', [KegiatanController::class, 'storeSetupJabatanPeserta'])->name('user.kegiatan.jabatan.peserta.store');
Route::post('/kegiatan/atur/jabatan/peserta/hapus', [KegiatanController::class, 'destroySetupJabatanPeserta'])->name('user.kegiatan.jabatan.peserta.destroy');
Route::get('/kegiatan/atur/jabatan/peserta/{kegiatanJabatanId}/get', [KegiatanController::class, 'getSetupJabatanPeserta'])->name('user.kegiatan.jabatan.peserta.get');
Route::get('/kegiatan/{id}/peserta/', [KegiatanController::class, 'getKegiatanPeserta'])->name('kegiatan.peserta.all');
Route::post('/peserta', [KegiatanController::class, 'getPeserta'])->name('peserta.get');
Route::get('kegiatan/{kegiatanId}/penerima', [KegiatanController::class, 'getPenerima'])->name('penerima.get');
Route::get('kegiatan/peserta-per-sesi-pembayaran/{pembayaranSesiId}', [KegiatanController::class, 'getPesertaPerSesiPembayaran'])->name('get.peserta.per-sesi-pembayaran');