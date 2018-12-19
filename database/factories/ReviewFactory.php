<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Review::class, function (FakerEng $faker) {
    return [
        'rating' => $faker->numberBetween(0, 5),
        'review' => Faker::sentence(),
        'created_at' => $faker->dateTime()
    ];
});
