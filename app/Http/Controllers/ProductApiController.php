<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProductApiController extends Controller
{
    public function index() {
        return Product::with('categories')->get();
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:products',
                'category' => 'required',
                'sku' => 'required|unique:products',
                'price' => 'required',
            ]);

            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

            $product = Product::create([
                'name' => $request['name'],
                'sku' => $request['sku'],
                'price' => $request['price'],
            ]);

            $categories = explode(", ", $request['category']);

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

        try {
            $validator = Validator::make($request->all(), [
                'name' => 'unique:products,name,' . $product->id,
                'sku' => 'unique:products,sku,' . $product->id,
            ]);

            if($validator->fails()) {
                return response()->json([
                    'errors' => $validator->errors()
                ], 400);
            }

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
        } catch (\Exception $e) {
            return response([
                'message' => $e->getMessage(),
            ], 406);
        }
    }

    public function destroy(Product $product) {
        $success = $product->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
