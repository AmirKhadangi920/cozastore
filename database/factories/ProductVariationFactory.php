<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ProductVariation::class, function (Faker $faker) {
    
    $price = $faker->numberBetween(1000, 20000000);
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'price' => $price,
        'unit' => 1,
        'offer' => $faker->numberBetween(1000, $price),
        'offer_deadline' => $faker->dateTimeBetween('now', '+2 years'),
        'stock_inventory' => $faker->numberBetween(0, 100),
    ];
});
