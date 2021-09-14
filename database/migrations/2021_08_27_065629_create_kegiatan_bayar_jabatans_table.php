<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanBayarJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_bayar_jabatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kegiatan_jabatan_id');
            $table->unsignedBigInteger('m_bayar_kategori_id');
            
            $table->timestamps();
            $table->foreign('kegiatan_jabatan_id')->references('id')->on('kegiatan_jabatans');        
            $table->foreign('m_bayar_kategori_id')->references('id')->on('m_bayar_kategoris');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_bayar_jabatans');
    }
}