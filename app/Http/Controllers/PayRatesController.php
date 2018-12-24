<?php

namespace App\Http\Controllers;

use App\PayRate;
use App\Customer;
use App\Http\Requests\PayRateStoreRequest;
use App\Http\Requests\PayRateUpdateRequest;

class PayRatesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $payRates = PayRate::all()->sortBy(function (PayRate $payRate, $key) {
            return optional($payRate->customer)->name . $payRate->rate;
        });
        return view('payrates.index', compact('payRates'));
    }

    public function create()
    {
        return view('payrates.create');
    }

    public function store(PayRateStoreRequest $request)
    {
        PayRate::create(
            $request->validated()
        );

        return redirect()->action('PayRatesController@index');
    }

    public function show(PayRate $payRate)
    {
        return view('payrates.show', compact('payRate'));
    }

    public function edit(PayRate $payRate)
    {
        return view('payrates.edit', compact('payRate'));
    }

    public function update(PayRateUpdateRequest $request, PayRate $payRate)
    {
        $payRate->update(
            $request->validated()
        );

        return redirect()->action('PayRatesController@index');
    }

    public function destroy(PayRate $payRate)
    {
        $payRate->delete();

        return redirect()->action('PayRatesController@index');
    }
}
