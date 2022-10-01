<?php

use App\Models\Product;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return $user = Product::with('categories')->find(1);
    foreach ($user->categories as $target) {
        echo $target->pivot->name;
    }
    return view('welcome');
});
