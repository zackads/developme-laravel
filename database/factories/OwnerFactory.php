<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Owner;
use Faker\Generator as Faker;

$factory->define(Owner::class, function (Faker $faker) {
    return [
        "first_name" => $faker->firstName,
        "last_name" => $faker->lastName,
        "telephone" => $faker->e164PhoneNumber,
        "email" => $faker->email,
        "address_1" => $faker->streetAddress,
        "address_2" => $faker->optional()->secondaryAddress,
        "town" => $faker->city,
        "postcode" => $faker->postcode,
    ];
});
