@extends('layoutcomponents.master')

@section('header')
Invoices
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title m-b-0">All invoices</h5>
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <i class="mdi mdi-plus"></i>
                    New invoice
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
