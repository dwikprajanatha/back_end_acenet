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
                'nama' => 'Ketut Wijaya',
                'username' => 'ketutketut',
                'password' => '$2y$10$rzgo2iVgJmG9hg/Ug.zwGuh65ARW.bl3Pj7UO01ybGY.ih..bPM5S',
                'email' => 'ketut.wijaya@ketut.com',
                'avatar' => NULL,
                'jabatan' => 'Backbone',
                'no_telp' => '019231023123',
                'remember_token' => NULL,
            ),
            1 => 
            array (
                'id' => '2',
                'nama' => 'Dwik Prajanatha',
                'username' => 'dwikdwik',
                'password' => '$2y$10$MFD/XysIabzU2rGKEKCJCOzfQAkzXWA7A2am9ob8AEem796SJG7IO',
                'email' => 'dwik@dwik.com',
                'avatar' => NULL,
                'jabatan' => 'teknisi',
                'no_telp' => '019231023',
                'remember_token' => NULL,
            ),
            2 => 
            array (
                'id' => '3',
                'nama' => 'Made Suparsana',
                'username' => 'suparsana',
                'password' => '$2y$10$lxRMefW2CWZu5iYETOTKROVpgEOcokElbnIWzAW.7aPqRvHNU35Xu',
                'email' => 'supar@supar.com',
                'avatar' => NULL,
                'jabatan' => 'teknisi',
                'no_telp' => '019231023',
                'remember_token' => NULL,
            ),
            3 => 
            array (
                'id' => '4',
                'nama' => 'Andika',
                'username' => 'dikadika',
                'password' => '$2y$10$h8ceN7zC5uh0DUAqfOPRQew.rtQbbwS9jB0tjTQ8sidx.H/70//2i',
                'email' => 'dika@dika.com',
                'avatar' => NULL,
                'jabatan' => 'Supervisor',
                'no_telp' => '0980123123',
                'remember_token' => NULL,
            ),
        ));
        
        
    }
}