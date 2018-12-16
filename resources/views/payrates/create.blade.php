@extends('layoutcomponents.master')

@section('header')
Pay rates
@endsection

@section('content')
<div class="row">
    <div class="col-8 offset-2">
        <form action="/payrates" method="POST" class="p-0 m-0">
            @csrf
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title m-b-0">Create new pay rate</h5>
                </div>

                <div class="card-body border-top">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" placeholder="Description of the pay rate..." value="{{ old('description') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-3">
                            <label>Rate</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">€</span>
                                </div>
                                <input type="text" name="rate" class="form-control" placeholder="Rate" value="{{ old('rate') }}">
                                <div class="input-group-append">
                                    <span class="input-group-text">/ hr</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-9">
                            <label>Customer <small class="text-muted">(optional)</small></label>
                            <select name="customer_id" class="form-control">

                                <option value="" {{ old('customer_id') ?: 'selected'}}>
                                    <span class="text-muted font-italic">
                                        - None -
                                    </span>
                                </option>

                                @foreach ($customers as $customer)
                                    <option value="{{ $customer->id }}"{{ old('customer_id') != $customer->id ?: ' selected' }}>
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
