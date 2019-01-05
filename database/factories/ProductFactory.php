<?php

use Faker\Generator as FakerEng;

$factory->define(App\Models\Product::class, function (FakerEng $faker) {
    $faker = \Faker\Factory::create('fa_IR');
    return [
        'id' => $faker->numberBetween(10000000, 99999999),
        'name' => $faker->name,
        'code' => $faker->ean8,
        'short_description' => Faker::sentence(),
        'aparat_video' => 'SEQ2V',
        'status' => 1,
        'full_description' => Faker::paragraph(),
        'keywords' => implode( ',', $faker->words( rand(1, 10) ) ),
        'photo' => $faker->imageUrl(480, 320),
        'gallery' => [$faker->imageUrl(480, 320)],
        'label' => $faker->numberBetween(0, 4),
        'advantages' => implode( ',', $faker->words( rand(1, 10) ) ),
        'disadvantages' => implode( ',', $faker->words( rand(1, 10) ) ),
    ];
});
