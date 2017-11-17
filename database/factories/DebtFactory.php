<?php

use Faker\Generator as Faker;

$factory->define(\App\Debt::class, function (Faker $faker) {
    return [
        'amount' => $faker->randomFloat(2, 0, 100000),
        'currency' => 'ruble',
        'name' => $faker->name,
        'type' => $faker->randomElement(['give', 'take']),
        'comment' => $faker->sentence
    ];
});
