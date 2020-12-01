<?php

use Illuminate\Database\Seeder;

class TbCustomerTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_customer')->delete();
        
        \DB::table('tb_customer')->insert(array (
            0 => 
            array (
                'id' => '1',
                'nama' => 'Wayan Wayan',
                'jenis_layanan' => 'Bronze',
                'no_telp' => '0912301923',
                'alamat' => 'taman muding',
                'tgl_instalasi' => '2020-11-29',
                'tgl_trial' => '2020-11-29',
            ),
            1 => 
            array (
                'id' => '3',
                'nama' => 'Made Made',
                'jenis_layanan' => 'Silver',
                'no_telp' => '0912301923',
                'alamat' => 'muding sari',
                'tgl_instalasi' => '2020-11-29',
                'tgl_trial' => '2020-11-29',
            ),
        ));
        
        
    }
}