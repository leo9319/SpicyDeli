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


        try {
            $validated = $request->validate([
                'name' => 'required|unique:products',
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
                'message' => 'product created',
                'data' => Product::with('categories')->find($product->id)
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 406);

        }
    }

    public function show(Product $product) {
        return Product::with('categories')->findOrFail($product->id);
    }

    public function update(Product $product, Request $request) {

        $product->update([
            'name' => $request['name'] ?? $product->name,
            'sku' => $request['sku'] ?? $product->sku,
            'price' => $request['price'] ?? $product->price,
        ]);

        if($request['category']) {
            $product->categories()->detach();
            $categories = explode(", ", $request['category']);

            for($j = 0; $j < count($categories); $j++) {
                $category =  Category::firstOrCreate(['name' =>  $categories[$j]]);
                $product->categories()->attach($category->id);
            }
        }

        return response([
            'message' => 'product updated',
            'data' => Product::with('categories')->find($product->id)
        ], Response::HTTP_OK);
    }

    public function destroy(Product $product) {
        $success = $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
