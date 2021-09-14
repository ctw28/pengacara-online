<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanBayarJabatanAtursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_bayar_jabatan_aturs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_bayar_jabatan_id');
            $table->integer('honor');
            $table->unsignedBigInteger('master_satuan_id');
            $table->integer('jumlah');
            
            $table->timestamps();
            $table->foreign('kegiatan_bayar_jabatan_id')->references('id')->on('kegiatan_bayar_jabatans')->onDelete('cascade');
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
        Schema::dropIfExists('kegiatan_bayar_jabatan_aturs');
    }
}