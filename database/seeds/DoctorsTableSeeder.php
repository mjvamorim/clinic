<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Doctor;


class DoctorsTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        foreach(range(1,20) as $index) {
            Doctor::insert([
                'name'      => $faker->name,
                'email'     => $faker->freeEmail,
                'zipcode'   => $faker->postcode,
                'address1'  => $faker->streetAddress,
                'address2'  => '',
                'district'  => '',
                'city'      => $faker->city,
                'state'     => $faker->stateAbbr,
                'mobile'    => str_random(10),
                'phone'     => str_random(10),   
            ]);
        }
    }
}