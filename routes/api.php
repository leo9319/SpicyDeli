<?php

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/categories', function() {
    // Category::create([
    //     'name' => 'Ethiopia',
    // ]);
    // Category::create([
    //     'name' => 'Meat',
    // ]);
    // Category::create([
    //     'name' => 'Beef',
    // ]);
    // Category::create([
    //     'name' => 'Chili pepper',
    // ]);
    // Category::create([
    //     'name' => 'China',
    // ]);
    // Category::create([
    //     'name' => 'Fish',
    // ]);
    // Category::create([
    //     'name' => 'Tofu',
    // ]);
    // Category::create([
    //     'name' => 'Sichuan pepper',
    // ]);
    // Category::create([
    //     'name' => 'Peru',
    // ]);
    // Category::create([
    //     'name' => 'Potato',
    // ]);
    // Category::create([
    //     'name' => 'Yellow Chili pepper',
    // ]);

    return Category::all();
});

Route::get('/products', function() {
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
    return Product::with('categories')->get();
});

Route::post('/products', function() {
    return Product::create([
        'name' => request('name'),
        'SKU' => request('name'),
        'price' => request('price'),
    ]);
});
