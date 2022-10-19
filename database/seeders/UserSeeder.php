<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => '0d8b7331-6e62-42c9-8fa1-5304a20c0db4',
                'lastname' => 'System',
                'othernames' => 'Administrator',
                'email' => 'root.administrator@odeluxurytailors.com',
                'phone' => '08000000001',
                'dob' => date_create(),
                'hire_date' => date_create(),
                'address' => 'www.odeluxurytailors.com',
                'employee_id' => 'OLTs-0000000001',
                'role_id' => 1,
                'gender_id' => 3,
                'country_id' => '160',
                'state_id' => '-1',
                'city_id' => '-1',
                'photo' => asset('storage/images/uploads/profile/system_administrator.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'id' => '0d657331-6e62-42c9-8fa1-7784a20c0db4',
                'lastname' => 'Ode',
                'othernames' => 'Ighayere Jigo',
                'email' => 'ighayere.ode@odeluxurytailors.com',
                'phone' => '070528475836',
                'dob' => '1990/08/14',
                'hire_date' => date_create(),
                'address' => 'Tested Ok.',
                'employee_id' => 'OLTs-1623518894',
                'role_id' => 2,
                'gender_id' => 1,
                'country_id' => '160',
                'state_id' => '32267',
                'city_id' => '-42998',
                'photo' => asset('storage/images/uploads/profile/default_profile_image.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'id' => '108a8281-c15f-4200-a41d-44f5aa403207',
                'lastname' => 'Tester',
                'othernames' => 'Manager Test',
                'email' => 'testmanager.tester@odeluxurytailors.com',
                'phone' => '07052847545',
                'dob' => '1990/08/14',
                'hire_date' => date_create(),
                'address' => 'Tested Ok.',
                'employee_id' => 'OLTs-162351101010',
                'role_id' => 3,
                'gender_id' => 1,
                'country_id' => '160',
                'state_id' => '32267',
                'city_id' => '-42998',
                'photo' => asset('storage/images/uploads/profile/default_profile_image.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'id' => '608bac29-8218-42bb-ac5b-2aa135f1d239',
                'lastname' => 'Tester',
                'othernames' => 'Head Tailor',
                'email' => 'tailorhead.tester@odeluxurytailors.com',
                'phone' => '070528475996',
                'dob' => '1990/08/14',
                'hire_date' => date_create(),
                'address' => 'Tested Ok.',
                'employee_id' => 'OLTs-1623519999',
                'role_id' => 4,
                'gender_id' => 1,
                'country_id' => '160',
                'state_id' => '32267',
                'city_id' => '-42998',
                'photo' => asset('storage/images/uploads/profile/default_profile_image.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'id' => 'b638b6b2-0ad1-4709-a970-81d1b523363a',
                'lastname' => 'Tester',
                'othernames' => 'Tailor Test',
                'email' => 'testtailor.tester@odeluxurytailors.com',
                'phone' => '070528499936',
                'dob' => '1990/08/14',
                'hire_date' => date_create(),
                'address' => 'Tested Ok.',
                'employee_id' => 'OLTs-1623518666',
                'role_id' => 5,
                'gender_id' => 1,
                'country_id' => '160',
                'state_id' => '32267',
                'city_id' => '-42998',
                'photo' => asset('storage/images/uploads/profile/default_profile_image.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ],[
                'id' => 'bdecc39f-3a78-441a-aa2c-95ef9403e4cf',
                'lastname' => 'Tester',
                'othernames' => 'Receptionist Test',
                'email' => 'testreceptionist.tester@odeluxurytailors.com',
                'phone' => '070529995836',
                'dob' => '1990/08/14',
                'hire_date' => date_create(),
                'address' => 'Tested Ok.',
                'employee_id' => 'OLTs-1623518855',
                'role_id' => 6,
                'gender_id' => 1,
                'country_id' => '160',
                'state_id' => '32267',
                'city_id' => '-42998',
                'photo' => asset('storage/images/uploads/profile/default_profile_image.png'),
                'reports_to' => '',
                'password' => Hash::make('BenzoicAcidC6H5COOH@1'),
                'created_at' => date_create(),
                'updated_at' => date_create()
            ]
        ]);
    }
}
