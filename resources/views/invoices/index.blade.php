@extends('layoutcomponents.master')

@php
\App\BreadCrumbs::set([
'Home' => route('dashboard') ,
'Invoices' => null ,
])
@endphp

@section('header')
Invoices
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="card-title m-b-0">All invoices</h5>
        <a href="{{ route('invoices.create') }}" class="btn btn-sm btn-outline-primary">
          <i class="mdi mdi-account-plus"></i>
          New Invoice
        </a>
      </div>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col" class="font-weight-bold" style="width:5%;">#</th>
            <th scope="col" class="font-weight-bold" style="width:79%;">Customer</th>
            <th scope="col" class="font-weight-bold" style="width:9%;">Amount</th>
            <th scope="col" class="font-weight-bold" style="width:7%;">Completed</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($invoices as $invoice)
          <tr>
            <th scope="row">
              <a href="{{ route('invoices.show', ['invoice' => $invoice->id]) }}">
                {{ $invoice->id }}
              </a>
            </th>
            <td>
              <a href="{{ route('customers.show', ['customer' => $invoice->customer->id ]) }}">
                {{ $invoice->customer->name }}
              </a>
            </td>
            <td>

              @if ($invoice->is_completed)
                <span class="badge badge-success font-weight-bold">Completed</span>
              @else
                <span class="badge badge-danger font-weight-bold">Not completed</span>
              @endif

            </td>
            <td>
              <div class="d-flex justify-content-around align-items-center">

                <a href="{{ route('invoices.edit', ['invoice' => $invoice->id]) }}">
                  <span class="mdi mdi-pencil"></span>
                </a>

                <form action="{{ route('invoices.destroy', ['invoice' => $invoice->id]) }}" method="POST" class="m-0 p-0">
                  @csrf
                  @method('DELETE')
                  <span class="btn-delete-invoice" style="cursor: pointer;">
                    <span class="mdi mdi-delete text-danger"></span>
                  </span>
                  <button type="submit" hidden></button>
                </form>

              </div>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection
