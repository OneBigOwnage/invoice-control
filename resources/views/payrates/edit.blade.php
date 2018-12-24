@extends('layoutcomponents.master')

@section('content')
<div class="row">
  <div class="col-8 offset-2">
    <form action="{{ route('payrates.update', ['payrate' => $payRate->id]) }}" method="POST" class="p-0 m-0">
      @csrf
      @method('PATCH')
      <div class="card">

        <div class="card-header">
          <h5 class="card-title m-b-0">{{ $payRate->description }}</h5>
        </div>

        <div class="card-body border-top">
          <div class="row">

            {{-- Description --}}
            <div class="col-12">
              <div class="form-group">
                <label>Description</label>
                <input type="text" name="description" class="form-control" placeholder="Description of this rate" value="{{ $payRate->description }}">
              </div>
            </div>

          </div>
          <div class="row">

            {{-- Rate --}}
            <div class="col-3">
              <div class="form-group">
                <label>Rate</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text">€</span>
                  </div>
                  <input type="text" name="rate" class="form-control" placeholder="Rate" value="{{ $payRate->rate }}">
                  <div class="input-group-append">
                    <span class="input-group-text">/ hr</span>
                  </div>
                </div>
              </div>
            </div>

            {{-- Customer --}}
            <div class="col-9">
              <label>Customer <small class="text-muted">(optional)</small></label>
              <select name="customer_id" class="form-control">

                <option value="" {{ $payRate->customer ?: 'selected'}}>
                  <span class="text-muted font-italic">
                    - None -
                  </span>
                </option>

                @foreach ($customers as $customer)
                <option value="{{ $customer->id }}"
                  {{ optional($payRate->customer)->id != $customer->id ?: ' selected' }}>
                  {{ $customer->name }}
                </option>
                @endforeach

              </select>
            </div>

          </div>
        </div>

        <div class="card-footer border-top d-flex justify-content-between align-items-center">
          <a href="{{ route('payrates.index') }}" class="btn btn-secondary">Back to overview</a>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
