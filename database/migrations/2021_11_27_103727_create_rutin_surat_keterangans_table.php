<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRutinSuratKeterangansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rutin_surat_keterangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengaturan_fakultas_id');
            $table->string('sk');
            $table->string('sk_tanggal');
            $table->string('sub_kegiatan');
            $table->string('no_bukti');
            $table->string('akun');
            $table->enum('is_aktif', ['0', '1']);

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
        Schema::dropIfExists('rutin_surat_keterangans');
    }
}
