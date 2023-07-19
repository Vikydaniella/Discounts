<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;

class CustomersController extends Controller
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


    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer, id)
    {
    $customer = Customer::find($id);
    if ($customer->total_spent > 1000) {
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

    
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
