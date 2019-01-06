<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Order::class, function (FakerEng $faker) {
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'admin_description' => Faker::sentence(),
        'buyer_description' => Faker::sentence(),
        'destination' => Faker::address(),
        'postal_code' => $faker->postcode,
        'total' => $faker->numberBetween(10000, 10000000),
        'status' => $faker->numberBetween(0, 7),
        'created_at' => $faker->dateTime(),
        'payment_jalali' => "{$faker->numberBetween(1380, 1397)}-0{$faker->numberBetween(1, 9)}-{$faker->numberBetween(10, 30)} 03:30:00"
    ];
});
