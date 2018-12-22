@extends('layoutcomponents.master')

@php
\App\BreadCrumbs::set([
    'Home'       => route('dashboard')      ,
    'Invoices'   => route('invoices.index') ,
    $invoice->id => null                    ,
])
@endphp

@section('content')
<div class="row">
  <div class="col-8 offset-2">
    <div class="card form-horizontal">

      <div class="card-header">
        <h5 class="card-title m-b-0">Invoice #{{ $invoice->id }}</h5>
      </div>

      <div class="card-body border-top">

            <div class="row">
                {{-- Customer --}}
                <div class="col-10">
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" readonly class="form-control" value="{{ $invoice->customer->name }}">
                    </div>
                </div>

                {{-- Completed --}}
                <div class="col-2">
                    <div class="form-group">
                        <label>Completed</label>
                        <input type="text" readonly class="form-control" value="{{ $invoice->is_completed ? 'Yes' : 'No' }}">
                    </div>
                </div>
            </div>

            <div class="row">

                {{-- Invoice date --}}
                <div class="col-5">
                    <div class="form-group">
                        <label>Invoice date</label>
                        <input type="text" readonly class="form-control" value="{{ $invoice->invoice_date ?? '-' }}">
                    </div>
                </div>

                {{-- Paid date --}}
                <div class="col-5">
                    <div class="form-group">
                        <label>Paid date</label>
                        <input type="text" readonly class="form-control" value="{{ $invoice->paid_date ?? '-' }}">
                    </div>
                </div>

                {{-- Payment amount --}}
                <div class="col-2">
                    <div class="form-group">
                        <label>Payment amount</label>
                        <input type="text" readonly class="form-control" value="{{ $invoice->sub_total ?? '-' }}">
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end mt-3">
                <a href="{{ route('invoices.edit', ['invoice'=> $invoice->id ]) }}" class="btn btn-primary">Edit invoice</a>
            </div>

      </div>

      <div class="card-body border-top">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5>Invoice rules</h5>
            <a href="{{ route('invoicedetails.create', ['invoice' => $invoice->id]) }}" class="btn btn-sm btn-outline-primary">Add invoice rule</a>
        </div>

        <table class="table table-hover table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col" class="font-weight-bold" style="width:5%;">#</th>
              <th scope="col" class="font-weight-bold" style="width:43%;">Task description</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Date</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Hours</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Rate</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Tax %</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Sub-total</th>
              <th scope="col" class="font-weight-bold" style="width:7%;">Actions</th>
            </tr>
          </thead>
          <tbody>

            @foreach ($invoice->details as $rule)

                <tr>
                    <th scope="col">{{ $rule->id }}</th>
                    <td>{{ $rule->description }}</td>
                    <td>{{ $rule->rate_id }}</td>
                    <td>{{ $rule->hours }}</td>
                    <td>{{ $rule->tax_percentate }}</td>
                    <td>{{ $rule->sub_total }}</td>
                    <td>{{ $rule->task_performed_date }}</td>
                    <td>actions</td>
                </tr>

            @endforeach


          </tbody>
        </table>

      </div>

      <div class="card-footer border-top d-flex justify-content-between align-items-center">
        <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Back to overview</a>
      </div>
    </div>
  </div>
</div>
@endsection
