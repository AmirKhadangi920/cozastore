<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Review::class, function (FakerEng $faker) {
    return [
        'value' => $faker->numberBetween(0, 5),
        'quality' => $faker->numberBetween(0, 5),
        'design' => $faker->numberBetween(0, 5),
        'total' => $faker->numberBetween(0, 5),
        'review' => Faker::sentence(),
        'created_at' => $faker->dateTime()
    ];
});
