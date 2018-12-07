<?php

use Faker\Generator as Faker;

$factory->define(App\OrderItem::class, function (Faker $faker) {
    return [
       'count' => $faker->numberBetween(1, 5), 
    ];
});
