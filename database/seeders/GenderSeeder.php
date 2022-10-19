<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->insert([
            [
                'name' => 'Male',
                'code' => 'M',
                'description' => 'Human caharacteristics of being a male.',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'name' => 'Female',
                'code' => 'F',
                'description' => 'Human caharacteristics of being a female.',
                'created_at' => date_create(),
                'updated_at' => date_create()                     
            ],[
                'name' => 'Others',
                'code' => 'OTH',
                'description' => 'None human entity or unknown gender.',
                'created_at' => date_create(),
                'updated_at' => date_create()                     
            ]
        ]);
    }
}
