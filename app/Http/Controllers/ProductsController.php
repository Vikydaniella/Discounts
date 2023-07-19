<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
