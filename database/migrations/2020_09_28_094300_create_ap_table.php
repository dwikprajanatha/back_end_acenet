<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_ap', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_bts");
            $table->string("nama_ap");
            $table->string("perangkat");
            $table->string("tipe");
            $table->string("ip_address");
            $table->date("installed_at");

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
        Schema::dropIfExists('ap');
    }
}
