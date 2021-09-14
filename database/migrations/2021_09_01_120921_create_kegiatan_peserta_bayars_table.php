<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPesertaBayarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_peserta_bayars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_pembayaran_sesi_id');
            $table->unsignedBigInteger('kegiatan_peserta_id');
            $table->unsignedBigInteger('master_satuan_id');
            $table->integer('honor');
            $table->integer('jumlah');
            $table->integer('pajak')->nullable();
            
            $table->timestamps();
            $table->foreign('kegiatan_pembayaran_sesi_id')->references('id')->on('kegiatan_pembayaran_sesis')->onDelete('cascade');
            $table->foreign('kegiatan_peserta_id')->references('id')->on('kegiatan_pesertas');        
            $table->foreign('master_satuan_id')->references('id')->on('master_satuans');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_peserta_bayars');
    }
}