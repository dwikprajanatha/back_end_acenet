<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_spk', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_customer");
            $table->unsignedBigInteger("id_admin");
            $table->string("no_spk");
            $table->string("ket_pekerjaan");
            $table->string("tgl_pekerjaan");
            $table->time("jam_mulai");
            $table->time("jam_selesai");
            $table->string("download_speed")->nullable();
            $table->string("upload_speed")->nullable();
            $table->string("ket_lanjutan")->nullable();
            $table->string("status");


            $table->foreign("id_customer")->references("id")->on("tb_customer");
            $table->foreign("id_admin")->references("id")->on("tb_admin");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_spk');
    }
}
