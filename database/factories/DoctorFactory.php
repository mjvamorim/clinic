<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    return [
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
    ];
});


