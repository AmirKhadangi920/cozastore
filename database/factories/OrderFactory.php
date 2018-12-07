<?php

use Faker\Generator as FakerEng;

$factory->define(App\Order::class, function (FakerEng $faker) {
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'admin_description' => Faker::sentence(),
        'buyer_description' => Faker::sentence(),
        'destination' => Faker::address(),
        'postal_code' => $faker->postcode,
        'total' => $faker->numberBetween(10000, 10000000),
        'status' => $faker->numberBetween(0, 7)
    ];
});
