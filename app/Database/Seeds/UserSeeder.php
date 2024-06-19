<?php

namespace App\Database\Seeds;

use App\Models\UserModel;
use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = \Faker\Factory::create('id_ID');
        $userModel = new UserModel();

        // Number of users to create
        $numberOfUsers = 10;

        for ($i = 0; $i < $numberOfUsers; $i++) {
            $male = $faker->boolean();
            if($male){
                $firstname = $faker->firstNameMale;
                $lastName = $faker->lastName;
            } else {
                $firstname = $faker->firstNameFemale;
                $lastName = $faker->lastName;
            }

            $fullname = $firstname . " " . $lastName;
            $email = strtolower($firstname) . $faker->numberBetween(100, 999) . '@' . $faker->freeEmailDomain;
            
            $data = [
                'email' => $email,
                'password' => 'password',
                'full_name' => $fullname,
                'nik' => $faker->numerify('############'),
                'phone_number' => $faker->numerify('##########'),
                'address' => $faker->address,
                'occupation' => $faker->jobTitle,
                'salary' => $faker->randomFloat(2, 1000000, 10000000),
                'bank' => $faker->company,
                'account_number' => $faker->numerify('##########'),
                'emergency_phone' => $faker->numerify('##########'),
                'emergency_relation' => $faker->randomElement(['Brother', 'Sister', 'Friend', 'Parent']),
                'balance' => '10000000'
            ];

            $userModel->insert($data);
        }

    }
}
