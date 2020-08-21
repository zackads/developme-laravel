<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Animal;
use Faker\Generator as Faker;
use App\Owner;

$factory->define(Animal::class, function (Faker $faker) {
    $names = ["Loki", "Spot", "Sparky", "Lassie", "Rocket", "Rupert", "Yogi"];
    $types = ["cat", "dog", "hamster", "gerbil", "bear", "tiger", "crocodile"];

    return [
        "name" => $names[array_rand($names, 1)],
        "type" => $types[array_rand($types, 1)],
        "dob" => $faker->date($format = 'Y-m-d', $max = 'now'),
        "weight" => rand(10, 100) / 10,
        "height" => rand(10, 30) / 10,
        "biteyness" => rand(1, 5)
    ];
});
