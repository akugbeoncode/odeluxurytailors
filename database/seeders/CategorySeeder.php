<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            [
                'parent_id' => 0,
                'name' => 'Attires',
                'meta_name' => 'attire,attire designs,clothes,wears,garments,designs',
                'description' => 'Fashion style worn by people that client can reference.',
                'image' => '/images/imageicon.png',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'parent_id' => 0,
                'name' => 'Accessories',
                'meta_name' => '',
                'description' => '',
                'image' => '/images/imageicon.png',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'parent_id' => 0,
                'name' => 'Fabrics',
                'meta_name' => 'fabrics,materials,clothes,client materials,client fabrics',
                'description' => '',
                'image' => '/images/imageicon.png',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'parent_id' => 0,
                'name' => 'Buttons',
                'meta_name' => '',
                'description' => '',
                'image' => '/images/imageicon.png',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ],[
                'parent_id' => 0,
                'name' => 'Trouser Options',
                'meta_name' => 'trouser,trouser option,pants',
                'description' => '',
                'image' => '/images/imageicon.png',
                'created_at' => date_create(),
                'updated_at' => date_create()          
            ]
        ]);
    }
}
