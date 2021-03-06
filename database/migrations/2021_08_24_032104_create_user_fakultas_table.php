<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserFakultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_fakultas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('idpeg'); //ini dari simpeg
            $table->unsignedBigInteger('master_fakultas_id');
            $table->enum('is_aktif',[0,1]);
            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('user_fakultas');
    }
}