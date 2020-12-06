<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaintenanceBts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_maintenance_bts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_spk");
            $table->unsignedBigInteger("id_bts");

            $table->foreign("id_spk")->references("id")->on("tb_spk");
            $table->foreign("id_bts")->references("id")->on("tb_bts");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('maintenance_bts');
    }
}
