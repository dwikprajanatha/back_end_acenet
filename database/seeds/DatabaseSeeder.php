<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(TbTeknisiTableSeeder::class);
        $this->call(TbTandaTanganTableSeeder::class);
        $this->call(TbSpkTableSeeder::class);
        $this->call(TbMaintenanceBtsTableSeeder::class);
        $this->call(TbIkrTableSeeder::class);
        $this->call(TbCustomerTableSeeder::class);
        $this->call(TbBtsTableSeeder::class);
        $this->call(TbApTableSeeder::class);
        $this->call(TbAdminTableSeeder::class);
        $this->call(PasswordResetsTableSeeder::class);
        $this->call(OauthRefreshTokensTableSeeder::class);
        $this->call(OauthPersonalAccessClientsTableSeeder::class);
        $this->call(OauthClientsTableSeeder::class);
        $this->call(OauthAuthCodesTableSeeder::class);
        $this->call(OauthAccessTokensTableSeeder::class);
        $this->call(MigrationsTableSeeder::class);
        $this->call(FailedJobsTableSeeder::class);
    }
}
