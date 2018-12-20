<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Spec\SpecRow::class, function (Faker $faker) {
    $multiple = $faker->numberBetween(0, 1);

    return [
        'title' => $faker->name(),
        'label' => $faker->name(),
        'values' => ($multiple) ? json_encode($faker->words(rand(1, 10))) : null,
        'multiple' => $multiple,
        'requierd' => $faker->numberBetween(0, 1),
        'min' => $faker->numberBetween(0, 8),
        'max' => $faker->numberBetween(30, 150)
    ];
});
