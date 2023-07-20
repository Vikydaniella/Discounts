<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        return CustomerResource::collection(Customer::all());
    }

    public function store(CustomerRequest $request)
    {
        $customer = Customer::firstOrCreate([
            'name' => $request->name,
            'since' => $request->since,
            'revenue' => $request->revenue,
            
        ]);
        if ($customer) {
            return response()->json([
                'status' => 200,
                'message' => 'Customer created successfully',
                'data' => $customer
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not create a customer.'
            ]);
    }

    public function show(Customer $customer, $id)
    {
       $customer = Customer::find($id);
       if($customer){
            return response()->json([
            'status' => 200,
            'message' => 'Successful',
            'data' => $customer,
            ]);
        }
        return response()->json([
            'status' => 500,
            'message' => 'Can not see customer'
        ]);  
    }

    public function discount(Customer $customer, $id)
    {
        $actualTotal = ;
    
    $customer = Customer::find($id);
    if ($customer->revenue > 1000) {
    $discountedTotal = $actualTotal * 0.1;
    return $discountedTotal;
    } else {
    return $actualTotal;
    $newRevenue = $customer->revenue + $actualTotal;
    return $newRevenue;
    }
    }

    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::find($id);
        if($customer){
        $customer->update([
            'name' => $request->name,
            'since' => $request->since,
            'revenue' => $request->revenue,
        ]);
            return response()->json([
                'status' => 200,
                'message' => 'Customer updated successfully',
                'data' => $customer
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not update customer'
            ]);
    }
    public function destroy(Customer $customer)
    {
        $customer = Customer::find($id);
        if ($customer){
        $customer->delete();
            return response()->json([
                'status' => 200,
                'message' => 'Customer deleted successfully',
                'data' => $customer
            ]);
        }  
            return response()->json([
                'status' => 500,
                'message' => 'Can not delete customer'
            ]);
    }
}
