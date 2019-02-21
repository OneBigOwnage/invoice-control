<?php

namespace App\Http\Controllers;

use Exception;
use App\Invoice;
use App\Customer;
use App\PayRate;
use App\Http\Requests\InvoiceStoreRequest;
use App\Http\Requests\InvoiceUpdateRequest;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        $invoices = Invoice::all();

        return view('invoices.index', compact('invoices'));
    }

    public function create()
    {
        return view('invoices.create');
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
        return view('invoices.edit', compact('invoice'));
    }

    public function update(Invoice $invoice, InvoiceUpdateRequest $request)
    {
        if ($invoice->is_completed) {
            return redirect()
                ->route('invoices.show', ['invoice' => $invoice->id])
                ->with(['toastrMessage' => (object) [
                    'type'    => 'error'                        ,
                    'message' => 'It is already completed.'     ,
                    'title'   => 'Not possible to edit invoice' ,
                ]]);
        }

        $invoice->update($request->only([
            'invoice_date' ,
            'paid_date'    ,
        ]));

        return redirect()->route('invoices.show', ['invoice' => $invoice->id]);
    }

    public function finalize(Invoice $invoice)
    {
        try {
            $invoice->finalize();
        } catch (Exception $ex) {
            return redirect()->back()->with(['toastrMessage' => (object) [
                'type'    => 'error' ,
                'message' => preg_replace('/\n/', '<br>', $ex->getMessage())     ,
                'title'   => ''     ,
            ]]);
        }

        $invoice->save();

        return redirect()->route('invoices.show', ['invoice' => $invoice]);
    }
}
