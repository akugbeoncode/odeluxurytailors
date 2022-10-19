<?php

namespace Database\Seeders;

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
        $this->call(CountrySeeder::class);
        $this->call(StateSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(GenderSeeder::class);
        $this->call(UserRoleSeeder::class);
        $this->call(UserActionSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(EmailSettingSeeder::class);
        $this->call(SmsSettingSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(UnitSeeder::class);
    }
}
