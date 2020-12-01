<?php

use Illuminate\Database\Seeder;

class OauthAccessTokensTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('oauth_access_tokens')->delete();
        
        \DB::table('oauth_access_tokens')->insert(array (
            0 => 
            array (
                'id' => '650762c3ade03621927f01b8829a633f02f6e3c263d029a28b5560c2c8a27986d9febef4e1852143',
                'user_id' => '1',
                'client_id' => '1',
                'name' => 'MyApp',
                'scopes' => '[]',
                'revoked' => '0',
                'created_at' => '2020-11-30 16:36:22.937',
                'updated_at' => '2020-11-30 16:36:22.937',
                'expires_at' => '2021-11-30 16:36:22.937',
            ),
            1 => 
            array (
                'id' => 'fb092e3a48b24b243091d3cfc48f1f41f76c618924ad1154a1fab1b19a710b95e21e24284c6ed2f2',
                'user_id' => '1',
                'client_id' => '1',
                'name' => 'MyApp',
                'scopes' => '[]',
                'revoked' => '0',
                'created_at' => '2020-11-29 04:06:38.607',
                'updated_at' => '2020-11-29 04:06:38.607',
                'expires_at' => '2021-11-29 04:06:38.607',
            ),
            2 => 
            array (
                'id' => 'ffcd90fbc656d8dead62b81b9c2da4b9eea1d1c726cd6c799b87351478ba060c79d462c2b391c666',
                'user_id' => '1',
                'client_id' => '1',
                'name' => 'MyApp',
                'scopes' => '[]',
                'revoked' => '0',
                'created_at' => '2020-11-29 03:32:35.850',
                'updated_at' => '2020-11-29 03:32:35.850',
                'expires_at' => '2021-11-29 03:32:35.850',
            ),
        ));
        
        
    }
}