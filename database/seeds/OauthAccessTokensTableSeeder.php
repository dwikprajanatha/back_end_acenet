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
                'id' => '8b4bca071a8427c9a07a2732b046211ed5145b690fb2f19978a2dd3a752d474fbf56d49d0f328c76',
                'user_id' => '2',
                'client_id' => '1',
                'name' => 'MyApp',
                'scopes' => '[]',
                'revoked' => '0',
                'created_at' => '2020-12-05 10:48:04.887',
                'updated_at' => '2020-12-05 10:48:04.887',
                'expires_at' => '2021-12-05 10:48:04.887',
            ),
        ));
        
        
    }
}