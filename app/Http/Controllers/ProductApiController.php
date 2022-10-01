<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    public function index() {
        return Product::with('categories')->get();
    }

    public function store() {
        request()->validate([
            'name' => 'required',
            'SKU' => 'required',
            'price' => 'required',
        ]);

        return Product::create([
            'name' => request('name'),
            'SKU' => request('SKU'),
            'price' => request('price'),
        ]);
    }

    public function update(Product $product) {
        request()->validate([
            'name' => 'required',
            'SKU' => 'required',
            'price' => 'required',
        ]);

        $success = $product->update([
            'name' => request('name'),
            'SKU' => request('SKU'),
            'price' => request('price'),
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Product $product) {
        $success = $product->delete();

        return [
            'success' => $success
        ];
    }

}
