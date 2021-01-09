<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tb_teknisi', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('username')->unique();
            // $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('email')->unique();
            $table->string('avatar')->nullable();
            $table->string("jabatan");
            $table->string("no_telp");
            $table->string("device_id");
            $table->tinyInteger('status')->default(1);
            $table->rememberToken();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tb_teknisi');
    }
}
