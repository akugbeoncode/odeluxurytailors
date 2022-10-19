<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SmsSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sms_settings')->insert([
            [
                'name' => 'employee_registration',
                'message' => 'Welcome #name to OLTs. Email: #email, Password: #password',
                'parameters' => '#name, #password, #email'
            ]
        ]);
    }
}
