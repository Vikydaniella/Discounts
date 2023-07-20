<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

    public function store(ProductRequest $request)
    {
        //
    }
    public function show(Product $product)
    {       
    $category = Category::where('name', 'Switches')->first();
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
    public function showTools(Product $product)
    {
        $category = Category::where('name', 'Tools')->first();
        $products = Product::where('category_id', $category->id)->get();
        $productCount = 2;
        if ($productCount >= 2) {
        $sortedProducts = $products->sortBy('price');
        $cheapestProduct = $sortedProducts->first();
        $discountAmount = $cheapestProduct->price * 0.2;
        $cheapestProduct->price -= $discountAmount;
        }
    }
    public function update(ProductRequest $request, Product $product)
    {
        //
    }
    public function destroy(Product $product)
    {
        //
    }
}
