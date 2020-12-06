<?php

use Illuminate\Database\Seeder;

class TbIkrTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT tb_ikr ON');


        \DB::table('tb_ikr')->delete();

        \DB::table('tb_ikr')->insert(array(
            0 =>
            array(
                'id' => '1',
                'id_spk' => '1',
                'id_teknisi' => '1',
            ),
            1 =>
            array(
                'id' => '2',
                'id_spk' => '2',
                'id_teknisi' => '1',
            ),
            2 =>
            array(
                'id' => '3',
                'id_spk' => '2',
                'id_teknisi' => '2',
            ),
            3 =>
            array(
                'id' => '4',
                'id_spk' => '6',
                'id_teknisi' => '1',
            ),
            4 =>
            array(
                'id' => '5',
                'id_spk' => '6',
                'id_teknisi' => '2',
            ),
            5 =>
            array(
                'id' => '12',
                'id_spk' => '7',
                'id_teknisi' => '2',
            ),
        ));

        DB::unprepared('SET IDENTITY_INSERT tb_ikr OFF');
        DB::commit();
    }
}
