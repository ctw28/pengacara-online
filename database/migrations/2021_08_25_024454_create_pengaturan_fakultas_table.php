<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturanFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_fakultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tahun_anggaran_pengaturan_id');
            $table->unsignedBigInteger('pengaturan_jabatan_id');
            $table->unsignedBigInteger('master_fakultas_id');

            $table->timestamps();
            $table->foreign('tahun_anggaran_pengaturan_id')->references('id')->on('tahun_anggaran_pengaturans');
            $table->foreign('pengaturan_jabatan_id')->references('id')->on('pengaturan_jabatans');
            $table->foreign('master_fakultas_id')->references('id')->on('master_fakultas');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan_fakultas');
    }
}