<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Ethiopia',
            'Meat',
            'Beef',
            'Chili pepper',
            'China',
            'Tofu',
            'Sichuan pepper',
            'Peru',
            'Potato',
            'Yellow Chili pepper',
        ];

        foreach($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }

    }
}
