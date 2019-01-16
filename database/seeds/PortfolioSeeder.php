<?php

use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{

    const ITEMS_LIMIT = 50;

    public function run()
    {
        if (\App\Models\Portfolio::count() >= self::ITEMS_LIMIT) return false;

        $items = factory(\App\Models\Portfolio::class, self::ITEMS_LIMIT)->create()->each(function ($item) {
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

        if (config('app.env') === 'testing') return false; // Break Seeding if it is tasting

        foreach ($items as $item) {
            $item->addMedia(database_path('seeds/images/') . rand(1, 9) . '.jpg')
                ->preservingOriginal()
                ->toMediaCollection('preview');

            for ($i = rand(1, 9); $i <= 9; $i++) {
                $item->addMedia(database_path('seeds/images/') . $i . '.jpg')
                    ->preservingOriginal()
                    ->toMediaCollection('images');
            }
        }


    }
}
