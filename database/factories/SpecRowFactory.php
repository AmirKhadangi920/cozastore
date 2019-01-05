<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Spec\SpecRow::class, function (Faker $faker) {
    $multiple = $faker->numberBetween(0, 1);

    return [
        'title' => $faker->name(),
        'label' => $faker->name(),
        'values' => ($multiple) ? $faker->words(rand(1, 10)) : null,
        'help' => $faker->paragraph(),
        'multiple' => $multiple,
    ];
});
