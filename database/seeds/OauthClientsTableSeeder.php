<?php

use Illuminate\Database\Seeder;

class OauthClientsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_clients')->delete();
        
        \DB::table('oauth_clients')->insert(array (
            0 => 
            array (
                'id' => '1',
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => '9mjbVTO4Yx0lOtODfbV6AlHphbR6TcGQ8DuM0rEX',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => '1',
                'password_client' => '0',
                'revoked' => '0',
                'created_at' => '2020-11-29 03:26:19.007',
                'updated_at' => '2020-11-29 03:26:19.007',
            ),
            1 => 
            array (
                'id' => '2',
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'yDmYZxIeeyn3ilQB3f9c5fjPqnvdwB6WiNzl7kl0',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => '0',
                'password_client' => '1',
                'revoked' => '0',
                'created_at' => '2020-11-29 03:26:19.210',
                'updated_at' => '2020-11-29 03:26:19.210',
            ),
        ));
        
        
    }
}