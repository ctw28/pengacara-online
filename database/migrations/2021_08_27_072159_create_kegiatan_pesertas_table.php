<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPesertasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_pesertas', function (Blueprint $table) {
            $table->id();
            $table->string('idpeg');
            $table->string('nip');
            $table->string('nama');
            $table->string('golongan')->nullable();
            $table->string('pajak')->nullable();
            $table->enum('is_iain',['0','1'])->default('1');
            $table->unsignedBigInteger('kegiatan_jabatan_id');            
            $table->timestamps();

            $table->foreign('kegiatan_jabatan_id')->references('id')->on('kegiatan_jabatans')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_pesertas');
    }
}