<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->insert([
            [
                "code" => "yd",
                "name" => "Yard",
                "base_unit" => 1,
                "operator" => "",
                "operational_value" => 1.00,
                'description' => '',
                "is_active" => 1,
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                "code" => "cm",
                "name" => "Centimeter",
                "base_unit" => 1,
                "operator" => "",
                "operational_value" => 1.00,
                'description' => '',
                "is_active" => 1,
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                "code" => "in",
                "name" => "Inch",
                "base_unit" => 1,
                "operator" => "*",
                "operational_value" => 1.00,
                'description' => '',
                "is_active" => 1,
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ]
        ]);
    }
}
