<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductApiController extends Controller
{
    public function index() {
        return Product::with('categories')->get();
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'sku' => 'required',
            'price' => 'required',
        ]);

        $product = Product::create([
            'name' => $validated['name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
        ]);

        $categories = explode(", ", $validated['category']);

        for($j = 0; $j < count($categories); $j++) {
            $category =  Category::firstOrCreate(['name' =>  $categories[$j]]);
            $product->categories()->attach($category->id);
        }

        return response([
            'message' => 'success',
            'data' => Product::with('categories')->find($product->id)
        ], Response::HTTP_CREATED);
    }

    public function show(Product $product) {
        return Product::with('categories')->findOrFail($product->id);
    }

    public function update(Product $product, Request $request) {
        $validated = $request->validate([
            'name' => 'required',
            'category' => 'required',
            'sku' => 'required',
            'price' => 'required',
        ]);

        $success = $product->update([
            'name' => $validated['name'],
            'sku' => $validated['sku'],
            'price' => $validated['price'],
        ]);

        return [
            'success' => $success
        ];
    }

    public function destroy(Product $product) {
        $success = $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
