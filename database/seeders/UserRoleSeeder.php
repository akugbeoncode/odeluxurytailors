<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_roles')->insert([
            [
                'title' => 'Super User',
                'code' => 'super_user',
                'access_level' => 'manager-services',
                'description' => 'Root administrator access level.',
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'title' => 'Executive',
                'code' => 'executive',
                'access_level' => 'manager-services',
                'description' => 'Top management access level',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'title' => 'Manager',
                'code' => 'manager',
                'access_level' => 'manager-services',
                'description' => 'Supervisor access level',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'title' => 'Head Tailor',
                'code' => 'head_tailor',
                'access_level' => 'tailor-services',
                'description' => 'Head of factory worker access level',
                'created_at' => date_create(),
                'updated_at' => date_create()          
                           

            ],[
                'title' => 'Tailor',
                'code' => 'tailor',
                'access_level' => 'tailor-services',
                'description' => 'Factory worker access level',
                'created_at' => date_create(),
                'updated_at' => date_create()                       
            ],[
                'title' => 'Receptionist',
                'code' => 'front_desk',
                'access_level' => 'frontdesk-services',
                'description' => 'Front desk access level',
                'created_at' => date_create(),
                'updated_at' => date_create()                       
            ],[
                'title' => 'Launderer',
                'code' => 'front_desk',
                'access_level' => 'laundry-services',
                'description' => 'Laundry front desk access level',
                'created_at' => date_create(),
                'updated_at' => date_create()                       
            ],[
                'title' => 'Driver',
                'code' => 'no_system_access',
                'access_level' => 'no-system-access',
                'description' => 'Employee does not have access to current system',
                'created_at' => date_create(),
                'updated_at' => date_create()                       
            ],[
                'title' => 'Cleaner',
                'code' => 'no_system_access',
                'access_level' => 'no-system-access',
                'description' => 'Employee does not have access to current system',
                'created_at' => date_create(),
                'updated_at' => date_create()                      
            ]
        ]);
    }
}
