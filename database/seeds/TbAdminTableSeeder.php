<?php

use Illuminate\Database\Seeder;

class TbAdminTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT tb_admin ON');

        \DB::table('tb_admin')->delete();

        \DB::table('tb_admin')->insert(array(
            0 =>
            array(
                'id' => '1',
                'nama_admin' => 'Made Cenik',
                'username' => 'madeCenik',
                'password' => '$2y$10$3kWDM6zbGO3D/SGLyM2wqumzGUm4PqLoRG1c5WbU98GI4ZrQWR84.',
            ),
        ));

        DB::unprepared('SET IDENTITY_INSERT tb_admin OFF');
        DB::commit();
    }
}
