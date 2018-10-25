<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Doctor::class, function (Faker $faker) {
    return [
        'name'        => $faker->name,
        'email'       => $faker->freeEmail,
        'mobile'      => $faker->e164PhoneNumber,
        'phone'       => $faker->e164PhoneNumber,
        'postal_code' => $faker->postcode,
        'street'      => $faker->streetAddress,
        'number'      => $faker->buildingNumber,
        'district'    => $faker->cityPrefix,
        'city'        => $faker->city,
        'state'       => $faker->stateAbbr,

    ];
});

