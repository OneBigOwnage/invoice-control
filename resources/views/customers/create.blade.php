@extends('layoutcomponents.master')

@section('content')
<div class="row">
  <div class="col-6 offset-3">
    <form action="/customers" method="POST" class="p-0 m-0">
      @csrf
      <div class="card">

        <div class="card-header">
          <h5 class="card-title m-b-0">Create new customer</h5>
        </div>

        <div class="card-body border-top">
          <div class="row">
            <div class="col-10 offset-1">
              <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" placeholder="Customer's name">
              </div>
            </div>
          </div>
        </div>

        <div class="card-footer border-top d-flex justify-content-between align-items-center">
          <a href="{{ route('customers.index') }}" class="btn btn-secondary">Back to overview</a>
          <button type="submit" class="btn btn-success">Save</button>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection
