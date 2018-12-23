@extends('layoutcomponents.master')

@php
\App\BreadCrumbs::set([
  'Home' => route('dashboard') ,
  'Invoices' => route('invoices.index') ,
  $invoice->id => null ,
])
@endphp

@section('content')
<div class="row">
  <div class="col-10 offset-1">
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
              <label>Invoice Completed</label>
              <input type="text" readonly class="form-control" value="{{ $invoice->is_completed ? 'Yes' : 'No' }}">
            </div>
          </div>
        </div>

        <div class="row">

          {{-- Invoice date --}}
          <div class="col-5">
            <div class="form-group">
              <label>Invoice date</label>
              <input type="text" readonly class="form-control" value="{{ optional($invoice->invoice_date)->toFormattedDateString() ?? '-' }}">
            </div>
          </div>

          {{-- Paid date --}}
          <div class="col-5">
            <div class="form-group">
              <label>Paid date</label>
              <input type="text" readonly class="form-control" value="{{ optional($invoice->paid_date)->toFormattedDateString() ?? '-' }}">
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

        @if (!$invoice->is_completed)
          <div class="d-flex justify-content-end mt-3">
            <form action="{{ route('invoices.finalize', ['invoice'=> $invoice->id ]) }}" method="POST" class="m-0 p-0">
              @csrf
              <button type="submit" class="btn btn-success mr-2">
                Finalize invoice
              </button>
            </form>
            <a href="{{ route('invoices.edit', ['invoice'=> $invoice->id ]) }}" class="btn btn-primary">Edit invoice</a>
          </div>
        @endif
      </div>

      <div class="card-body border-top">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5>Invoice rules</h5>
          @if (!$invoice->is_completed)
            <a href="{{ route('invoicedetails.create', ['invoice' => $invoice->id]) }}" class="btn btn-sm btn-outline-primary">
              Add invoice rule
            </a>
          @endif
        </div>

        <table class="table table-hover table-bordered table-sm">
          <thead>
            <tr>
              <th scope="col" class="font-weight-bold" style="width:43%;">Task description</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Date</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Time</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Rate</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Tax %</th>
              <th scope="col" class="font-weight-bold" style="width:9%;">Sub-total</th>

              @if (!$invoice->is_completed)
                  <th scope="col" class="font-weight-bold" style="width:7%;">Actions</th>
              @endif

            </tr>
          </thead>
          <tbody>

            @foreach ($invoice->details as $detail)

            <tr>
              <td>
                {{ $detail->description }}
              </td>
              <td>
                {{ $detail->task_performed_date->toFormattedDateString() }}
              </td>
              <td>
                {{ $detail->formattedTime }}
              </td>
              <td class="text-right">
                <span data-toggle="tooltip" data-placement="top" title="{{ $detail->rate->description }}">
                  €&nbsp;{{ $detail->rate->rate }}&nbsp;/h
                </span>
              </td>
              <td class="text-right">
                {{ $detail->tax_percentage }}&nbsp;%
              </td>
              <td class="text-right">
                €&nbsp;{{ $detail->sub_total }}
              </td>
              @if (!$invoice->is_completed)
                <td>
                  <div class="d-flex justify-content-around align-items-center">

                    <a href="{{ route('invoicedetails.edit', ['invoice' => $invoice->id, 'details' => $detail->id]) }}">
                      <span class="mdi mdi-pencil"></span>
                    </a>
                    <form action="{{ route('invoicedetails.destroy', ['invoice' => $invoice->id, 'details' => $detail->id]) }}" method="POST" class="m-0 p-0">
                      @csrf
                      @method('DELETE')
                      <span class="btn-delete-invoice-details" style="cursor: pointer;">
                        <span class="mdi mdi-delete text-danger"></span>
                      </span>
                      <button type="submit" hidden></button>
                    </form>

                  </div>
                </td>
              @endif
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

@push('scripts')
<script>
  $('.btn-delete-invoice-details').on('click', function (event) {

    window.deleteInvoiceDetails = () => {
      $(this).parents('form').first().submit()
    };

    $('#modal-confirm-delete')
      .modal('show')
      .on('shown.bs.modal', function() {
        $('#modal-confirm-delete button[data-dismiss="modal"]').focus();
      });
  });
</script>
@endpush

@push('extra-content')
<div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Confirm delete invoice rule</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this invoice rule from the invoice?<br>
        This action cannot be undone!
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-danger" onclick="deleteInvoiceDetails()">Delete this invoice rule</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Go back to safety</button>
      </div>
    </div>
  </div>
</div>
@endpush
