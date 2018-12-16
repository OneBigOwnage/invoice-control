@extends('layoutcomponents.master')

@section('header')
Invoices
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="card-title m-b-0">Alle invoices</h5>
                <button type="button" class="btn btn-sm btn-outline-primary">
                    <i class="mdi mdi-credit-card-plus"></i>
                    New invoice
                </button>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col" class="font-weight-bold" style="width:5%;">#</th>
                        <th scope="col" class="font-weight-bold" style="width:25%;">First</th>
                        <th scope="col" class="font-weight-bold" style="width:25%;">Last</th>
                        <th scope="col" class="font-weight-bold" style="width:45%;">Handle</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Larry</td>
                    <td>the Bird</td>
                    <td>@twitter</td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
