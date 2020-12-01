<?php

use Illuminate\Database\Seeder;

class TbTandaTanganTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_tanda_tangan')->delete();
        
        \DB::table('tb_tanda_tangan')->insert(array (
            0 => 
            array (
                'id' => '1',
                'id_spk' => '2',
                'role' => 'Customer',
                'path' => 'ttd_customer/QrkJrm8ugY7ppZvT5wOjMwgM6gpRTHRZuAyRbdCs.jpeg',
                'status' => '1',
            ),
            1 => 
            array (
                'id' => '2',
                'id_spk' => '2',
                'role' => 'Teknisi',
                'path' => 'ttd_teknisi/YWmPG8naxR2W0Wis2zhtE9zInbCXhsrn7HihHIh4.jpeg',
                'status' => '1',
            ),
            2 => 
            array (
                'id' => '3',
                'id_spk' => '2',
                'role' => 'Customer',
                'path' => 'ttd_customer/8qHjRCPyLvUCWH99iJjtbCumOAHlRZeNP4jeBDbB.jpeg',
                'status' => '1',
            ),
            3 => 
            array (
                'id' => '4',
                'id_spk' => '2',
                'role' => 'Teknisi',
                'path' => 'ttd_teknisi/NmJZCLfTNyg2I10qOzwTI9Ahlckg6ForaBycxEAF.jpeg',
                'status' => '1',
            ),
            4 => 
            array (
                'id' => '5',
                'id_spk' => '2',
                'role' => 'Customer',
                'path' => 'ttd_customer/iPeUTJJHLsLubSBZQKZGpnq0Z7TytIuR0iw0gaw3.jpeg',
                'status' => '1',
            ),
            5 => 
            array (
                'id' => '6',
                'id_spk' => '2',
                'role' => 'Teknisi',
                'path' => 'ttd_teknisi/vDz7MXHIGYIsrZGZ8Bwna157cMBfBco71rtLdPzB.jpeg',
                'status' => '1',
            ),
        ));
        
        
    }
}