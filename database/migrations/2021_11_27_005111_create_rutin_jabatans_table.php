<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinJabatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutin_jabatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaturan_fakultas_id');
            $table->string('jabatan_nama');
            $table->string('jabatan_keterangan');

            $table->timestamps();
            $table->foreign('pengaturan_fakultas_id')->references('id')->on('pengaturan_fakultas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rutin_jabatans');
    }
}
