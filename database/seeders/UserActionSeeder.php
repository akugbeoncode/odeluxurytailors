<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_actions')->insert([
            [
                'action' => 'logged in',
                'connector_phrase' => 'to',
                'subject' => 'Ode Luxury Tailors Management System',
                'description' => '',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ]
        ]);
    }
}
