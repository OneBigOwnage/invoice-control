<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::all();
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(CustomerStoreRequest $request)
    {
        Customer::create(
            $request->validated()
        );

        return redirect()->action('CustomersController@index');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $customer->update(
            $request->validated()
        );

        return redirect()->action('CustomersController@index');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->action('CustomersController@index');
    }
}
