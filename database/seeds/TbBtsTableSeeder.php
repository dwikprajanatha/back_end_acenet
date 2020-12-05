<?php

use Illuminate\Database\Seeder;

class TbBtsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_bts')->delete();
        
        \DB::table('tb_bts')->insert(array (
            0 => 
            array (
                'id' => '1',
                'nama_bts' => 'BTS Canggu',
                'lokasi' => 'Dons Bakery Canggu',
                'status' => '1',
            ),
            1 => 
            array (
                'id' => '2',
                'nama_bts' => 'BTS Batu Bulan',
                'lokasi' => 'Deket Kober',
                'status' => '1',
            ),
        ));
        
        
    }
}