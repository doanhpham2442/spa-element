<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $faker = Faker::create();
        $limit = 5000;

        for ($i = 0; $i < $limit; $i++){
            DB::table('users')->insert([
                'name' => $faker->name,
                'phone' => $faker->numerify($string = '09########'),
                'email' => $faker->unique->email,
                'gender' => '1',
                'birthday' => $faker->dateTimeBetween('-50 years', '-18 years')->format('Y-m-d'),
                'ethnic' => $faker->numberBetween(1, 55),
                'province' => str_pad($faker->numberBetween(1, 96), 2, '0', STR_PAD_LEFT),
                // 'parent_id' => $faker->numberBetween(94960, 95000),
            ]);
        }
    }
}

