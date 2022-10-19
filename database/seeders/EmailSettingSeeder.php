<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_settings')->insert([
            [
                'name' => 'employee_registration',
                'subject' => "OLTs Employee Account Registration",
                'body' => '<p>Dear #name, <br /><br /> Welcome to Ode Luxury Tailors management team. <br /> <br /> Your account login credentials are listed below, please use the email and password token to login and if you are unable to login, contact the administrator or manager for assistant.  <br /><br />Email Address: &nbsp;&nbsp;<strong>#email</strong> <br />Password: &nbsp;&nbsp;<strong>#password</strong></p><p>Please use the link provided below to access the login portal. <br />Note: Kindly change your password upon login</p>',
                'parameters' => '#name, #password, #email'
            ]
        ]);
    }
}
