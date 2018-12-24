<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\PayRate;
use App\InvoiceDetails;
use App\Http\Requests\InvoiceDetailsStoreRequest;
use App\Http\Requests\InvoiceDetailsUpdateRequest;

class InvoiceDetailsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function create(Invoice $invoice)
    {
        return view('invoice-details.create', compact('invoice'));
    }

    public function store(Invoice $invoice, InvoiceDetailsStoreRequest $request)
    {
        if ($invoice->is_completed) {
            return redirect()
                ->route('invoices.show', ['invoice' => $invoice->id])
                ->with(['toastrMessage' => (object) [
                    'type'    => 'error'                              ,
                    'message' => 'This invoice is already completed.' ,
                    'title'   => 'Not possible to add another rule'   ,
                ]]);
        }

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
        return view('invoice-details.edit', compact('invoice', 'detail'));
    }

    public function update(Invoice $invoice, InvoiceDetails $detail, InvoiceDetailsUpdateRequest $request)
    {
        if ($invoice->is_completed) {
            return redirect()
                ->route('invoices.show', ['invoice' => $invoice->id])
                ->with(['toastrMessage' => (object) [
                    'type'    => 'error'                              ,
                    'message' => 'This invoice is already completed.' ,
                    'title'   => 'Not possible to edit this rule'   ,
                ]]);
        }

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
