<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Customer;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceStoreRequest;

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
}
