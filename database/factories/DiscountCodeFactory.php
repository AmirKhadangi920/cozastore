<?php

use Faker\Generator as Faker;

$factory->define(App\Models\DiscountCode::class, function (Faker $faker) {
    $use = $faker->numberBetween(0, 1);

    return [
        'code' => $faker->numberBetween(10000000, 99999999),
        'value' => $faker->numberBetween(1000, 100000),
        'using_time' => ($use) ? $faker->dateTime() : null
    ];
});
