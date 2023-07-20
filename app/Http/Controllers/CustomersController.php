<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Customer;

class CustomersController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }


    public function store(CustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer, id)
    {
    $customer = Customer::find($id);
    if ($customer->revenue > 1000) {
    $discountedTotal = $orderTotal * 0.1;
    return $discountedTotal;
    } else {
    return $orderTotal;
    }
    }

    public function edit(Customer $customer)
    {
        //
    }

    
    public function update(CustomerRequest $request, Customer $customer)
    {
        //
    }
    public function destroy(Customer $customer)
    {
        //
    }
}
