<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function customerOrder($customerId, $items)
{
    $discountedTotal = $this->customerDiscount($customerId, $items);
    $discountedTotal = $this->switchDiscount($items, $discountedTotal);
    $discountedTotal = $this->toolDiscount($items, $discountedTotal);
    
    return $discountedTotal;
}

protected function customerDiscount($customerId, $items)
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

    return $actualTotal;
}
       
protected function switchDiscount($items, $totalPrice)
{
    $categorySwitches = Product::where('category', 2)->first();

    if ($categorySwitches) {
        $productCount = 0;

        foreach ($items as $item) {
            if ($item['product_id'] === $categorySwitches->id) {
                $productCount += $item['quantity'];
            }
        }

        $freeProductCount = floor($productCount / 5);

        if ($freeProductCount > 0) {
            $freeProductsTotalPrice = $categorySwitches->price * $freeProductCount;
            $totalPrice -= $freeProductsTotalPrice;
        }
    }

    return $totalPrice;
}

protected function toolDiscount($items, $totalPrice)
{
    $categoryTools = Product::where('category', 1)->first();

    if ($categoryTools) {
        $productCount = 0;

        foreach ($items as $item) {
            if ($item['product_id'] === $categoryTools->id) {
                $productCount += $item['quantity'];
            }
        }

        if ($productCount >= 2) {
            $sortedProducts = collect($items)->filter(function ($item) use ($categoryTools) {
                return $item['product_id'] === $categoryTools->id;
            })->sortBy('price');

            $cheapestProduct = $sortedProducts->first();
            $discountAmount = $cheapestProduct['price'] * 0.2;
            $cheapestProduct['price'] -= $discountAmount;

            $totalPrice -= $discountAmount;
        }
    }

    return $totalPrice;
}
   
}