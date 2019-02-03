<?php

use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{

    const ITEMS_LIMIT = 21;

    public function run()
    {

        if (\App\Models\Portfolio::count() >= self::ITEMS_LIMIT) return false;

        factory(\App\Models\Portfolio::class, self::ITEMS_LIMIT)->create()->each(function ($item) {
            $categories = array_pluck(\App\Models\Category::inRandomOrder()->take(rand(1, 4))->get(['id'])->toArray(), 'id');

            $item->categories()->attach($categories);

            $item->saveSeo([
                'title' => [
                    'ru' => 'Русский тайтл',
                    'en' => 'English Title'
                ],
                'description' => [
                    'ru' => 'Русское описание',
                    'en' => 'English description'
                ],
                'keywords' => [
                    'ru' => 'Русское описание',
                    'en' => 'English description'
                ]
            ]);

        });
    }
}
