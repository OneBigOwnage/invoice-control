<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Customer;
use App\PayRate;
use App\Http\Requests\InvoiceStoreRequest;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        $customers = Customer::all();
        return view('invoices.create', compact('customers'));
    }

    public function store(InvoiceStoreRequest $request)
    {
        $invoice = Invoice::create([
            'customer_id' => request('customer_id')
        ]);

        return redirect()->action('InvoicesController@show', compact('invoice'));
    }

    public function show(Invoice $invoice)
    {
        return view('invoices.show', compact('invoice'));
    }

    public function edit(Invoice $invoice)
    {
        $rates = PayRate::forCustomer($invoice->customer);

        return view('invoices.edit', [
            'invoice' => $invoice,
            'rates' => $rates
        ]);
    }
}
