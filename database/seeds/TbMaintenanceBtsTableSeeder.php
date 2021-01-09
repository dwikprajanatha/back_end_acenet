<?php

use Illuminate\Database\Seeder;

class TbMaintenanceBtsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_maintenance_bts')->delete();
        
        \DB::table('tb_maintenance_bts')->insert(array (
            0 => 
            array (
                'id' => '1',
                'id_spk' => '9',
                'id_bts' => '1',
            ),
            1 => 
            array (
                'id' => '4',
                'id_spk' => '9',
                'id_bts' => '2',
            ),
        ));
        
        
    }
}