<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Portfolio::class, function (Faker $faker) {
    return [
        'title' => [
            'ru' => $faker->text(30) . ' RU',
            'en' => $faker->text(30) . ' EN',
        ],
        'description' => [
            'ru' => 'RU ' . $faker->realText(150),
            'en' => 'EN ' . $faker->realText(150),
        ],
        'content' => [
            'ru' => 'RU ' . $faker->realText(1000),
            'en' => 'EN ' . $faker->realText(1000),
        ],
        'link' => $faker->url,
        'dir_path' => rand(1, 3) === 2 ? 'storage/html/template' : null,
        'image' => 'storage/fake-images/' . rand(1, 8) . '.jpg',
        'user_id' => (\App\Models\User::first(['id']))->id,
        'published_at' => now()
    ];
});
