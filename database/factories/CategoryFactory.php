<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Category::class, function (FakerEng $faker) {
    return [
        'title' => Faker::fullName(),
        'description' => Faker::sentence(),
        'avatar' => $faker->imageUrl(100, 100)
    ];
});
