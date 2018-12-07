<?php

use Faker\Generator as Faker;

$factory->define(App\ProductVariation::class, function (Faker $faker) {
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'price' => $faker->numberBetween(1000, 20000000),
        'warranty' => 'گارانتی یک ساله آواژنگ',
        'price' => $faker->numberBetween(1000, 10000000),
        'unit' => 1,
        'offer' => $faker->numberBetween(0, 99),
        'offer_deadline' => $faker->dateTimeBetween('now', '+2 years'),
        'stock_inventory' => $faker->numberBetween(0, 100),
    ];
});
