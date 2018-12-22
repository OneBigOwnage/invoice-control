<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\PayRate;
use App\InvoiceDetails;
use App\Http\Requests\InvoiceDetailsStoreRequest;

class InvoiceDetailsController extends Controller
{
    public function create(Invoice $invoice)
    {
        $rates = PayRate::
            where('customer_id', $invoice->customer->id)
            ->orWhereNull('customer_id')
            ->get();

        return view('invoice-details.create')
            ->with('invoice', $invoice)
            ->with('rates', $rates);
    }

    public function store(Invoice $invoice, InvoiceDetailsStoreRequest $request)
    {
        $details = new InvoiceDetails($request->only([
            'rate_id'             ,
            'tax_percentage'      ,
            'description'         ,
            'task_performed_date' ,
        ]));

        $details->invoice_id = $invoice->id;

        $details->setMinutesFromTimeString($request->input('time'));

        $details->save();

        return redirect()->route('invoices.show', ['invoice' => $invoice]);
    }
}
