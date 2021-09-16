<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPembayaransTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_id');            
            $table->unsignedBigInteger('kegiatan_peserta_id');            
            $table->date('kegiatan_pembayaran_tanggal');
            $table->date('kegiatan_pembayaran_tanggal_lunas');
            $table->enum('status',[0,1])->default(0);
            $table->timestamps();

            $table->foreign('kegiatan_id')->references('id')->on('kegiatans')->onDelete('cascade');
            $table->foreign('kegiatan_peserta_id')->references('id')->on('kegiatan_pesertas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_pembayarans');
    }
}