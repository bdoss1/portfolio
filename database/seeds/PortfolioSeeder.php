<?php

use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{

    const ITEMS_LIMIT = 21;

    public function run()
    {

        if (\App\Models\Portfolio::count() >= self::ITEMS_LIMIT) return false;

        $items = factory(\App\Models\Portfolio::class, self::ITEMS_LIMIT)->create()->each(function ($item) {
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

        if (config('app.env') === 'testing') return false;

        foreach ($items as $item) {
            $item->addMedia(database_path('seeds/images/') . rand(1, 9) . '.jpg')
                ->preservingOriginal()
                ->withCustomProperties([
                    'alt' => 'Alt'
                ])
                ->toMediaCollection('preview');

            for ($i = rand(1, 9); $i <= 9; $i++) {
                $item->addMedia(database_path('seeds/images/') . $i . '.jpg')
                    ->preservingOriginal()
                    ->withCustomProperties([
                        'alt' => 'Alt',
                        'description' => [
                            'ru' => 'Превью',
                            'en' => 'preview'
                        ]
                    ])
                    ->toMediaCollection('images');
            }
        }

    }
}
