<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTandaIkrTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ikr', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_spk");
            $table->foreignId("id_teknisi");

            $table->foreign("id_spk")->references("id")->on("tb_spk");
            $table->foreign("id_teknisi")->references("id")->on("tb_teknisi");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_ikr');
    }
}
