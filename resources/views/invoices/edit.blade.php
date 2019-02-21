@extends('layoutcomponents.master')

@section('content')
<div class="row">
  <div class="col-6 offset-3">
    <form action="{{ route('invoices.update', compact('invoice')) }}" method="POST" class="p-0 m-0">
      @csrf
      @method('PATCH')
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
                <input type="text" name="invoice_date" class="form-control" autocomplete="off" value="{{ old('invoice_date') ?? optional($invoice->invoice_date)->toDateString() }}">
              </div>
            </div>
            <div class="col-3">
              <div class="form-group">
                <label>Paid date</label>
                <input type="text" name="paid_date" class="form-control" autocomplete="off" value="{{ old('paid_date') ?? optional($invoice->paid_date)->toDateString() }}">
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

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/css/bootstrap-datepicker.min.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.8.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>
<script>
  $('[name="invoice_date"], [name="paid_date"]').datepicker({
    autoclose: true,
    todayHighlight: true,
    orientation: 'bottom',
    format: 'yyyy-mm-dd'
  });
</script>
@endpush
