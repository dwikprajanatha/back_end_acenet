<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTandaTanganTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_tanda_tangan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_spk");
            $table->string("role");
            $table->string("path");
            $table->string("status");

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
        Schema::dropIfExists('tb_tanda_tangan');
    }
}
