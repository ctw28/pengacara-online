<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaturan_fakultas_id');
            $table->text('kegiatan_nama');
            $table->date('kegiatan_tanggal');
            $table->string('kegiatan_sub_kegiatan');
            $table->string('kegiatan_akun');
            $table->string('kegiatan_no_bukti')->nullable();
            $table->string('kegiatan_sk');
            $table->date('kegiatan_sk_tanggal');

            $table->timestamps();
            $table->foreign('pengaturan_fakultas_id')->references('id')->on('pengaturan_fakultas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatans');
    }
}