<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function discount($customerId, $items)
{
    $customer = Customer::find($customerId);
    $actualTotal = 0.0;

    foreach ($items as $item) {
        $quantity = $item['quantity'];
        $price = $item['price'];
        $actualTotal += $quantity * $price;
    }

    $newRevenue = $customer->revenue + $actualTotal;

    if ($newRevenue > 1000) {
        $discountedTotal = $actualTotal * 0.1; 
        return $discountedTotal;
    }

    $categorySwitches = Product::where('category_id', 2)->first();
    if ($categorySwitches) {
        $productCount = 0;
        foreach ($items as $item) {
            if ($item['product_id'] === $categorySwitches->id) {
                $productCount += $item['quantity'];
            }
        }
        $freeProductCount = floor($productCount / 5);
        $totalPrice = $actualTotal;
        if ($freeProductCount > 0) {
            $freeProductsTotalPrice = $categorySwitches->price * $freeProductCount;
            $totalPrice -= $freeProductsTotalPrice;
        }
    } else {
        $totalPrice = $actualTotal;
    }

    $categoryTools = Product::where('category_id', 1)->first();
    if ($categoryTools) {
        $productCount = 0;
        foreach ($items as $item) {
            if ($item['product_id'] === $categoryTools->id) {
                $productCount += $item['quantity'];
            }
        }
        if ($productCount >= 2) {
            $sortedProducts = $items->filter(function ($item) use ($categoryTools) {
                return $item['product_id'] === $categoryTools->id;
            })->sortBy('price');
            $cheapestProduct = $sortedProducts->first();
            $discountAmount = $cheapestProduct['price'] * 0.2; // 20% discount
            $cheapestProduct['price'] -= $discountAmount;
        }
    }

    return $totalPrice;
}
}