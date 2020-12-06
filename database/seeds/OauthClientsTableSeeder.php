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
        DB::beginTransaction();
        DB::unprepared('SET IDENTITY_INSERT oauth_clients ON');


        \DB::table('oauth_clients')->delete();

        \DB::table('oauth_clients')->insert(array(
            0 =>
            array(
                'id' => '1',
                'user_id' => NULL,
                'name' => 'Laravel Personal Access Client',
                'secret' => 'NQB1ZsGNROX93F84wAxqeJVz4qw4bA0AFKvfrcF8',
                'provider' => NULL,
                'redirect' => 'http://localhost',
                'personal_access_client' => '1',
                'password_client' => '0',
                'revoked' => '0',
                'created_at' => '2020-12-03 02:15:41.377',
                'updated_at' => '2020-12-03 02:15:41.377',
            ),
            1 =>
            array(
                'id' => '2',
                'user_id' => NULL,
                'name' => 'Laravel Password Grant Client',
                'secret' => 'N03Yco8VHuUUYQd8QcRv0uLC6LOpbUE7iRSlvMq9',
                'provider' => 'users',
                'redirect' => 'http://localhost',
                'personal_access_client' => '0',
                'password_client' => '1',
                'revoked' => '0',
                'created_at' => '2020-12-03 02:15:41.520',
                'updated_at' => '2020-12-03 02:15:41.520',
            ),
        ));

        DB::unprepared('SET IDENTITY_INSERT oauth_clients OFF');
        DB::commit();
    }
}
