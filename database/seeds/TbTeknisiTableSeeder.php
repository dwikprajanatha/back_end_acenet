<?php

use Illuminate\Database\Seeder;

class TbTeknisiTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tb_teknisi')->delete();
        
        \DB::table('tb_teknisi')->insert(array (
            0 => 
            array (
                'id' => '1',
                'nama' => 'dwik',
                'username' => 'dwikdwik',
                'password' => '$2y$10$kEaA3k/NsNAYnnipwGQXTeYdMPB/Eez9G5yeEzwmNGmPxUvVebb1q',
                'email' => 'dwik@dwik.com',
                'avatar' => NULL,
                'jabatan' => 'teknisi',
                'no_telp' => '0851321312',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => '3',
                'nama' => 'Ketut',
                'username' => 'ketutketut',
                'password' => '$2y$10$Opamk9LxBLnbILo6eYKtnu1MGKSC2UXESavAtpigCoHq3Qfj3neba',
                'email' => 'ketut@ketut.com',
                'avatar' => NULL,
                'jabatan' => 'teknisi',
                'no_telp' => '019231023',
                'remember_token' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}