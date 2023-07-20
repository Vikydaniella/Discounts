<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductResource::collection(Product::all());
    }

    public function store(ProductRequest $request)
    {
        $product = Product::firstOrCreate([
            'id' => $request->id,
            'description' => $request->description,
            'category' => $request->category,
            'price'=> $request->price,
            
        ]);
        if ($product) {
            return response()->json([
                'status' => 200,
                'message' => 'Customer created successfully',
                'data' => $product
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not create a customer.'
            ]);
    }

    public function show(Product $product, $id)
    {
       $product = Product::find($id);
       if($product){
            return response()->json([
            'status' => 200,
            'message' => 'Successful',
            'data' => $product,
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Can not see product'
        ]);  
    }
    public function switchDiscount(Product $product)
    {       
    $category = Product::where('category', '2')->first();
    $products = Product::where('category_id', $category->id)->get();
    $productCount = 5;
    $freeProductCount = floor($productCount / 5);
    $totalPrice = 0;
    foreach ($products as $product) {
    $quantity = $productCount > $freeProductCount ? $productCount - $freeProductCount : $productCount;
    $totalPrice += $product->price * $quantity;
    $productCount -= $quantity;
}

    }
    public function toolDiscount(Product $product)
    {
        $category = Product::where('category', '1')->first();
        $products = Product::where('category_id', $category->id)->get();
        $productCount = 2;
        if ($productCount >= 2) {
        $sortedProducts = $products->sortBy('price');
        $cheapestProduct = $sortedProducts->first();
        $discountAmount = $cheapestProduct->price * 0.2;
        $cheapestProduct->price -= $discountAmount;
        }
    }
    public function update(ProductRequest $request, $id)
    {
        $product = Product::find($id);
        if($product){
        $product->update([
            'id' => $request->id,
            'description' => $request->description,
            'category' => $request->category,
            'price'=> $request->price,
        ]);
            return response()->json([
                'status' => 200,
                'message' => 'Product updated successfully',
                'data' => $product
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not update product'
            ]);
    }
    public function destroy(Product $product, $id)
    {
        $product = Product::find($id);
        if ($product){
        $product->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer deleted successfully',
                'data' => $product
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not delete customer'
            ]);
    }
}
