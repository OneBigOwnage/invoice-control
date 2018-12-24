@extends('layoutcomponents.master')

@section('content')
<div class="row">
  <div class="col-6 offset-3">
    <div class="card form-horizontal">

      <div class="card-header">
        <h5 class="card-title m-b-0">
          {{ $payRate->description }}
        </h5>
      </div>

      <div class="card-body border-top">

        {{-- Description --}}
        <div class="form-group row">
          <label for="lname" class="col-sm-3 control-label col-form-label">Description</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" value="{{ $payRate->description }}">
          </div>
        </div>

        {{-- Rate --}}
        <div class="form-group row">
          <label for="lname" class="col-sm-3 control-label col-form-label">Rate</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" value="€ {{ $payRate->rate }} / hr">
          </div>
        </div>

        {{-- Customer --}}
        <div class="form-group row">
          <label for="lname" class="col-sm-3 control-label col-form-label">Customer</label>
          <div class="col-sm-9">
            <input type="text" readonly class="form-control" value="{{ optional($payRate->customer)->name ?? '-' }}">
          </div>
        </div>

      </div>

      <div class="card-footer border-top d-flex justify-content-between align-items-center">
        <a href="{{ route('payrates.index') }}" class="btn btn-secondary">Back to overview</a>
        <a href="{{ route('payrates.edit', ['payRate'=> $payRate->id ]) }}" class="btn btn-primary">Edit</a>
      </div>
    </div>
  </div>
</div>
@endsection
