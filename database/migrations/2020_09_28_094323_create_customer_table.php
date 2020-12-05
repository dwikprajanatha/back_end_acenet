<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_customer', function (Blueprint $table) {
            $table->id();
            $table->foreignId("id_ap");
            $table->string("no_pelanggan");
            $table->string("nama");
            $table->string("jenis_layanan");
            $table->string("no_telp");
            $table->string("alamat");
            $table->date("tgl_instalasi");
            $table->date("tgl_trial");

            $table->foreign("id_ap")->references("id")->on("tb_ap");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_customer');
    }
}
