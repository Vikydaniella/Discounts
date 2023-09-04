<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;

class OrderController extends Controller
{
    public function discount(OrderRequest $request)
    {
        $customerId = $request->input('customer_id');
        $items = $request->input('items');

        $discountedTotal = $this->customerDiscount($customerId);
        $discountedTotal = $this->switchDiscount($items, $discountedTotal);
        $discountedTotal = $this->toolDiscount($items, $discountedTotal);

        return $discountedTotal;
    }

    protected function customerDiscount($customerId)
    {
        $customer = Customer::find($customerId);

        if (!$customer) {
            return null;
        }

        $customerTotal = Order::where('customer_id', $customerId)->sum('total');
        $newRevenue = $customer->revenue + $customerTotal;

        if ($newRevenue > 1000) {
            $discountedTotal = $customerTotal - ($customerTotal * 0.1);
            $customer->revenue = $newRevenue;
            $customer->save();
            return $discountedTotal;
        }

        return $customerTotal;
    }

    protected function switchDiscount($items, $totalPrice)
    {
        $categorySwitches = Product::where('category', 2)->first();

        if (!$categorySwitches) {
            return $totalPrice;
        }

        $productCount = 0;

        foreach ($items as $item) {
            
            $orders = DB::table('orders')
                ->whereJsonContains('items', ['product-id'=> 'B102'])
                ->get();

            if ($orders && $orders->product-id === $categorySwitches->id) {
                $productCount += $item['quantity'];
                dd($productCount, $item['quantity']);
            }
        }

        $freeProductCount = floor($productCount / 5);

       dd($item, $freeProductCount, $productCount);

        if ($freeProductCount > 0) {
            $freeProductsTotalPrice = $categorySwitches->price * $freeProductCount;
            $totalPrice -= $freeProductsTotalPrice;
        }

        return $totalPrice;
    }

    protected function toolDiscount($items, $totalPrice)
    {
        $categoryTools = Product::where('category', 1)->first();

        if ($categoryTools) {
            $productCount = 0;


            foreach ($items as $item) {
                $orderItem = DB::table('orders')
                ->whereJsonContains('items', ['product-id' => 'B102'])
                ->get();
                if ($orderItem && $orderItem->product-id === $categoryTools->id) {
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
