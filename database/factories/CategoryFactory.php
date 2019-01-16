<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Category::class, function (Faker $faker) {
    return [
        'title' => [
            'ru' => 'RU ' . $faker->text(10),
            'en' => 'EN ' . $faker->text(10)
        ]
    ];
});
