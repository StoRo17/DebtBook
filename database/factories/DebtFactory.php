<?php

use Faker\Generator as Faker;

$factory->define(\App\Debt::class, function (Faker $faker) {
    return [
        'total_amount' => $faker->randomFloat(2, 0, 100000),
        'currency' => $faker->randomElement(['1', '2', '3']),
        'name' => $faker->name,
    ];
});
