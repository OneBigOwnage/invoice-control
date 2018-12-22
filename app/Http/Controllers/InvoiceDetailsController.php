<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\PayRate;
use App\InvoiceDetails;
use App\Http\Requests\InvoiceDetailsStoreRequest;
use App\Http\Requests\InvoiceDetailsUpdateRequest;

class InvoiceDetailsController extends Controller
{
    public function create(Invoice $invoice)
    {
        $rates = PayRate::forCustomer($invoice->customer)->get();

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

    public function edit(Invoice $invoice, InvoiceDetails $detail)
    {
        $rates = PayRate::forCustomer($invoice->customer)->get();

        return view('invoice-details.edit', [
            'invoice' => $invoice,
            'details' => $detail,
            'rates'   => $rates
        ]);
    }

    public function update(Invoice $invoice, InvoiceDetails $detail, InvoiceDetailsUpdateRequest $request)
    {
        $detail->fill($request->only([
            'rate_id'           ,
            'tax_percentage'    ,
            'description'       ,
            'task_perform_date' ,
        ]));

        $detail->setMinutesFromTimeString($request->input('time'));

        $detail->update();

        return redirect()->route('invoices.show', ['invoice' => $invoice]);
    }

    public function destroy(Invoice $invoice, InvoiceDetails $detail)
    {
        $detail->delete();
        return redirect()->route('invoices.show', ['invoice' => $invoice->id]);
    }
}
