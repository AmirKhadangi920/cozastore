<?php

use Faker\Generator as Faker;

$factory->define(App\Models\OrderItem::class, function (Faker $faker) {
    return [
       'count' => $faker->numberBetween(1, 5), 
    ];
});
