<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function discount(Request $request)
    {
        $id = $request->input('id');
        $customer_id = $request->input('customer-id');
        $items = $request->input('items');
        $total_cost = $request->input('total');
        $total_cost = $this->customerDiscount($customer_id, $total_cost);
        $total_cost = $this->switchDiscount($items, $total_cost);
        $total_cost = $this->toolDiscount($items, $total_cost);
        return $total_cost;
    }
     protected function customerDiscount($customerId, $total_cost)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return null; 
        }

        if ($customer->revenue > 1000) {
            $discountedTotal = $total_cost - ($total_cost * 0.1);
            return $discountedTotal;
        }
        return $total_cost;
    }

    protected function switchDiscount($items, $total_cost)
    {
        foreach ($items as &$item) {
            $item_id = $item['product-id'];
            $product = Product::find($item_id);

            if ($product && $product->category === 2) {
                $quantity = $item['quantity'];
                $freeItems = intdiv($quantity, 5);
                $item['quantity'] += $freeItems; 
            }
        }

        return $item['quantity'];
    }

    protected function toolDiscount($items, $total_cost)
{
    $toolProducts = Product::where('category', 1)->get();

    if ($toolProducts->isEmpty()) {
        return $total_cost;
    }

    $cheapestProduct = null;

    foreach ($items as &$item) {
        $item_id = $item['product-id'];
        $product = Product::find($item_id);

        if ($product && $product->category === 1) {
            if (!$cheapestProduct || $item['unit-price'] < $cheapestProduct->price) {
                $cheapestProduct = $product;
            }
        }
    }

    if ($cheapestProduct) {
        $discount = $cheapestProduct->price * 0.2;
        $cheapestProduct->price -= $discount;
        return $cheapestProduct->price;
    }

    return $total_cost;
}
}