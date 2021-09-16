<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKegiatanPembayaranSesisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatan_pembayaran_sesis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pembayaran_id');            
            $table->unsignedBigInteger('kegiatan_bayar_jabatan_id');
            $table->timestamps();

            $table->foreign('pembayaran_id')->references('id')->on('kegiatan_pembayarans')->onDelete('cascade');
            $table->foreign('kegiatan_bayar_jabatan_id')->references('id')->on('kegiatan_bayar_jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kegiatan_pembayaran_sesis');
    }
}