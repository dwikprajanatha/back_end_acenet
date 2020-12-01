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
        

        \DB::table('tb_ikr')->delete();
        
        \DB::table('tb_ikr')->insert(array (
            0 => 
            array (
                'id' => '1',
                'id_spk' => '2',
                'id_teknisi' => '1',
            ),
            1 => 
            array (
                'id' => '2',
                'id_spk' => '3',
                'id_teknisi' => '1',
            ),
            2 => 
            array (
                'id' => '3',
                'id_spk' => '3',
                'id_teknisi' => '3',
            ),
        ));
        
        
    }
}