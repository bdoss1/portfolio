<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Blog::class, function (Faker $faker) {
    return [
        'title' => [
            'ru' => $faker->text(30) . ' RU',
            'en' => $faker->text(30) . ' EN',
        ],
        'description' => [
            'ru' => 'RU ' . $faker->realText(400),
            'en' => 'EN ' . $faker->realText(400),
        ],
        'content' => [
            'ru' => 'RU ' . $faker->realText(1000),
            'en' => 'EN ' . $faker->realText(1000),
        ],
        'link' => $faker->url,
        'user_id' => (\App\Models\User::first(['id']))->id,
        'published_at' => now()
    ];
});
