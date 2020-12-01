<?php

use Illuminate\Database\Seeder;

class TbSpkTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_spk')->delete();
        
        \DB::table('tb_spk')->insert(array (
            0 => 
            array (
                'id' => '2',
                'id_customer' => '1',
                'id_admin' => '1',
                'no_spk' => '10012312',
                'ket_pekerjaan' => 'perbaikan antenna',
                'tgl_pekerjaan' => '2020-12-01',
                'jam_mulai' => '03:55:21.0000000',
                'jam_selesai' => '03:55:21.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => 'Sukses bor',
                'status' => '1',
            ),
            1 => 
            array (
                'id' => '3',
                'id_customer' => '3',
                'id_admin' => '1',
                'no_spk' => '10012312',
                'ket_pekerjaan' => 'ganti router',
                'tgl_pekerjaan' => '2020-12-01',
                'jam_mulai' => '04:00:10.0000000',
                'jam_selesai' => '04:00:10.0000000',
                'download_speed' => NULL,
                'upload_speed' => NULL,
                'ket_lanjutan' => NULL,
                'status' => '1',
            ),
        ));
        
        
    }
}