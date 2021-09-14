<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengaturanJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengaturan_jabatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('master_jabatan_id');
            $table->string('idpeg'); //ini dari simpeg atau ini ganti saja jadi nama
            $table->enum('is_aktif',[0,1]);
            $table->string('keterangan');
            $table->timestamps();

            $table->foreign('master_jabatan_id')->references('id')->on('master_jabatans');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengaturan_jabatans');
    }
}