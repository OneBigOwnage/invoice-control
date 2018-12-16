@extends('layoutcomponents.master')

@section('header')
Customers
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="card-title m-b-0">All customers</h5>
        <a href="{{ route('customers.create') }}" class="btn btn-sm btn-outline-primary">
          <i class="mdi mdi-account-plus"></i>
          New customer
        </a>
      </div>
      <table class="table table-hover table-sm">
        <thead>
          <tr>
            <th scope="col" class="font-weight-bold" style="width:5%;">#</th>
            <th scope="col" class="font-weight-bold" style="width:88%;">Name</th>
            <th scope="col" class="font-weight-bold" style="width:7%;">Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($customers as $customer)
          <tr>
            <th scope="row">{{ $customer->id }}</th>
            <td>
              <a href="{{ route('customers.show', ['customer' => $customer->id ]) }}">
                {{ $customer->name }}
              </a>
            </td>
            <td class="d-flex justify-content-around align-items-center">
              <a href="{{ route('customers.edit', ['customer' => $customer->id ]) }}" class="btn btn-xs btn-outline-primary px-1 py-0">
                <span class="mdi mdi-pencil mdi-18px"></span>
              </a>
              <form action="{{ route('customers.destroy', ['customer' => $customer->id ]) }}" method="POST" class="p-0"
                data-delete="customer">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-xs btn-outline-danger px-1 py-0 btn-delete-customer">
                  <span class="mdi mdi-delete mdi-18px"></span>
                </button>
                <button type="submit" hidden></button>
              </form>
            </td>
          </tr>
          @endforeach

        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection


@push('scripts')
<script>
  $('.btn-delete-customer').on('click', function (event) {
    $('#modal-confirm-delete')
      .modal('show')
      .on('shown.bs.modal', function() {
        $('#modal-confirm-delete button[data-dismiss="modal"]').focus();
      });
  });

  const deleteCustomer = () => {
    $('[data-delete="customer"]').submit();
  }
    </script>
@endpush


@push('extra-content')
<div class="modal fade" id="modal-confirm-delete" tabindex="-1" role="dialog"style="display: none;"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm delete customer</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this customer?<br>
        This action cannot be undone!
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-danger" onclick="deleteCustomer()">Delete this customer</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Go back to safety</button>
      </div>
    </div>
  </div>
</div>
@endpush
