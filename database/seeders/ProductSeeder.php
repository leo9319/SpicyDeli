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
                'SKU' => $products_array[$i]['sku'],
                'price' => $products_array[$i]['price']
            ]);

            $categories = explode(", ", $products_array[$i]['category']);

            for($j = 0; $j < count($categories); $j++) {
                echo $categories[$j];

                $category =  Category::firstOrCreate(['name' =>  $categories[$j]]);
                $product->categories()->attach($category->id);
            }



        }



        // Product::create([
        //     'name' => 'Sik Sik Wat',
        //     'SKU' => 'DISH999ABCD',
        //     'price' => 13.49
        // ]);
        // Product::create([
        //     'name' => 'Huo Guo',
        //     'SKU' => 'DISH234ZFDR',
        //     'price' => 11.99
        // ]);
        // Product::create([
        //     'name' => 'Huo Guo',
        //     'SKU' => 'DISH775TGHY',
        //     'price' => 15.29
        // ]);
    }
}
