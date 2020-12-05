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
                'id_ap' => '1',
                'no_pelanggan' => 'ACE-001',
                'nama' => 'Made Made',
                'jenis_layanan' => 'Silver',
                'no_telp' => '0912301923',
                'alamat' => 'muding sari',
                'tgl_instalasi' => '2020-12-03',
                'tgl_trial' => '2020-12-03',
            ),
            1 => 
            array (
                'id' => '2',
                'id_ap' => '2',
                'no_pelanggan' => 'ACE-002',
                'nama' => 'Wayan Rooney',
                'jenis_layanan' => 'Gold',
                'no_telp' => '0912301923',
                'alamat' => 'muding sari',
                'tgl_instalasi' => '2020-12-03',
                'tgl_trial' => '2020-12-03',
            ),
            2 => 
            array (
                'id' => '3',
                'id_ap' => '2',
                'no_pelanggan' => 'ACE-003',
                'nama' => 'John Doe',
                'jenis_layanan' => 'Gold',
                'no_telp' => '0912301923',
                'alamat' => 'Canggu Permai',
                'tgl_instalasi' => '2020-12-03',
                'tgl_trial' => '2020-12-03',
            ),
        ));
        
        
    }
}