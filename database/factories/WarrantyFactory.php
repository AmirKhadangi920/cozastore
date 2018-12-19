<?php

use Faker\Generator as Faker;

$warranties = [
    'طلایی',
    'آواژنگ',
    'مدیران',
    'دیجی کالا',
    'عودت وجه'
];

$factory->define(App\Models\Warranty::class, function (Faker $faker) use ($warranties) {
    return [
        'title' => $warranties[$faker->numberBetween(0, 4)],
        'expire' => $faker->numberBetween(1, 5) . ' ساله',
    ];
});
