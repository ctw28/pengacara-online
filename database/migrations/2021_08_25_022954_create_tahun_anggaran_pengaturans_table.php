<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTahunAnggaranPengaturansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tahun_anggaran_pengaturans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_anggaran_id');
            $table->unsignedBigInteger('pengaturan_jabatan_id');
            $table->timestamps();

            $table->foreign('tahun_anggaran_id')->references('id')->on('master_tahun_anggarans');
            $table->foreign('pengaturan_jabatan_id')->references('id')->on('pengaturan_jabatans');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tahun_anggaran_pengaturans');
    }
}