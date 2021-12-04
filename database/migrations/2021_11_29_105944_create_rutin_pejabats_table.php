<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinPejabatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutin_pejabats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('rutin_surat_keterangan_id');
            $table->unsignedBigInteger('rutin_jabatan_id');
            $table->string('idpeg');
            $table->string('nama');
            $table->string('nip');
            $table->string('golongan');
            $table->string('pajak');
            $table->string('honor');
            $table->enum('status', ['0', '1']);

            $table->timestamps();
            $table->foreign('rutin_surat_keterangan_id')->references('id')->on('rutin_surat_keterangans')->onDelete('cascade');
            $table->foreign('rutin_jabatan_id')->references('id')->on('rutin_jabatans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutin_pejabats');
    }
}
