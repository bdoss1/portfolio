<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{

    const ITEMS_LIMIT = 10;

    public function run()
    {
        if (\App\Models\Category::count() >= self::ITEMS_LIMIT) return false;
        factory(\App\Models\Category::class, self::ITEMS_LIMIT)->create();
    }
}
