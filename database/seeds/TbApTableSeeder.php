<?php

use Illuminate\Database\Seeder;

class TbApTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_ap')->delete();
        
        \DB::table('tb_ap')->insert(array (
            0 => 
            array (
                'id' => '1',
                'id_bts' => '1',
                'nama_ap' => 'Canggu 1',
                'perangkat' => 'LHG',
                'tipe' => 'P2P',
                'ip_address' => '192.168.1.101',
                'installed_at' => '2018-12-12',
            ),
            1 => 
            array (
                'id' => '2',
                'id_bts' => '1',
                'nama_ap' => 'Canggu 2',
                'perangkat' => 'Metal',
                'tipe' => 'Multi',
                'ip_address' => '192.168.1.115',
                'installed_at' => '2017-07-05',
            ),
            2 => 
            array (
                'id' => '3',
                'id_bts' => '1',
                'nama_ap' => 'Canggu 3',
                'perangkat' => 'Bullet',
                'tipe' => 'Multi',
                'ip_address' => '192.168.1.58',
                'installed_at' => '2018-07-21',
            ),
            3 => 
            array (
                'id' => '4',
                'id_bts' => '2',
                'nama_ap' => 'BatuBulan-Kober',
                'perangkat' => 'Bullet',
                'tipe' => 'Multi',
                'ip_address' => '192.168.15.58',
                'installed_at' => '2018-02-01',
            ),
        ));
        
        
    }
}