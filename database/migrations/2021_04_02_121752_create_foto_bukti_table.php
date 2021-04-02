<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotoBuktiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_foto_bukti', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_spk");
            $table->string("path");
            $table->tinyInteger("status");

            $table->foreign("id_spk")->references("id")->on("tb_spk");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_foto_bukti');
    }
}
