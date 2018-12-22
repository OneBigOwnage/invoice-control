@extends('layoutcomponents.master')

@php
\App\BreadCrumbs::set([
    'Home'             => route('dashboard')                         ,
    'Invoices'         => route('invoices.index')                    ,
    "#{$invoice->id}"  => route('invoices.show', compact('invoice')) ,
    'Edit'             => null                                       ,
])
@endphp

@section('content')
<div class="row">
    <div class="col-6 offset-3">
        <form action="{{ route('invoices.update', compact('invoice')) }}" method="POST" class="p-0 m-0">
            @csrf
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title m-b-0">Edit invoice #{{ $invoice->id }}</h5>
                </div>

                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Customer</label>
                                <input type="text" class="form-control" readonly value="{{ $invoice->customer->name }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Invoice date</label>
                                <input type="text" name="invoice_date" class="form-control" value="{{ old('invoice_date') ?? $invoice->invoice_date }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="paid_date" class="form-control" value="{{ old('paid_date') ?? $invoice->paid_date }}">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('invoices.show', compact('invoice')) }}" class="btn btn-secondary">Back to invoice</a>
                    <button type="submit" class="btn btn-success">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
