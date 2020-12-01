<?php

use Illuminate\Database\Seeder;

class MigrationsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('migrations')->delete();
        
        \DB::table('migrations')->insert(array (
            0 => 
            array (
                'id' => '1',
                'migration' => '2014_10_12_000000_create_users_table',
                'batch' => '1',
            ),
            1 => 
            array (
                'id' => '2',
                'migration' => '2014_10_12_100000_create_password_resets_table',
                'batch' => '1',
            ),
            2 => 
            array (
                'id' => '3',
                'migration' => '2016_06_01_000001_create_oauth_auth_codes_table',
                'batch' => '1',
            ),
            3 => 
            array (
                'id' => '4',
                'migration' => '2016_06_01_000002_create_oauth_access_tokens_table',
                'batch' => '1',
            ),
            4 => 
            array (
                'id' => '5',
                'migration' => '2016_06_01_000003_create_oauth_refresh_tokens_table',
                'batch' => '1',
            ),
            5 => 
            array (
                'id' => '6',
                'migration' => '2016_06_01_000004_create_oauth_clients_table',
                'batch' => '1',
            ),
            6 => 
            array (
                'id' => '7',
                'migration' => '2016_06_01_000005_create_oauth_personal_access_clients_table',
                'batch' => '1',
            ),
            7 => 
            array (
                'id' => '8',
                'migration' => '2019_08_19_000000_create_failed_jobs_table',
                'batch' => '1',
            ),
            8 => 
            array (
                'id' => '9',
                'migration' => '2020_09_28_094005_create_admin_table',
                'batch' => '1',
            ),
            9 => 
            array (
                'id' => '10',
                'migration' => '2020_09_28_094323_create_customer_table',
                'batch' => '1',
            ),
            10 => 
            array (
                'id' => '11',
                'migration' => '2020_09_28_094536_create_spk_table',
                'batch' => '1',
            ),
            11 => 
            array (
                'id' => '12',
                'migration' => '2020_09_28_095115_create_tanda_tangan_table',
                'batch' => '1',
            ),
            12 => 
            array (
                'id' => '13',
                'migration' => '2020_09_28_095159_create_tanda_ikr_table',
                'batch' => '1',
            ),
        ));
        
        
    }
}