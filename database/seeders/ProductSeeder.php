<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::disk('local')->get('/public/spicy_deli.json');
        $products_array = json_decode($json, true)['products'];

        for($i = 0; $i < count($products_array); $i++) {
            $product = Product::create([
                'name' => $products_array[$i]['name'],
                'sku' => $products_array[$i]['sku'],
                'price' => $products_array[$i]['price']
            ]);

            $categories = explode(", ", $products_array[$i]['category']);

            for($j = 0; $j < count($categories); $j++) {
                $category =  Category::firstOrCreate(['name' =>  $categories[$j]]);
                $product->categories()->attach($category->id);
            }

        }

    }
}
