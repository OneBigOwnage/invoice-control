@extends('layoutcomponents.master')

@section('header')
Pay rates
@endsection

@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body d-flex justify-content-between align-items-center">
        <h5 class="card-title m-b-0">All pay rates</h5>
        <a href="{{ route('payrates.create') }}" class="btn btn-sm btn-outline-primary">
          <i class="mdi mdi-account-plus"></i>
          New pay rate
        </a>
      </div>
      <table class="table table-hover table-bordered" id="pay-rates-table">
        <thead>
          <tr>
            <th scope="col" class="font-weight-bold" style="width:5%;">#</th>
            <th scope="col" class="font-weight-bold" style="width:20%;">Customer</th>
            <th scope="col" class="font-weight-bold" style="width:61%;">Description</th>
            <th scope="col" class="font-weight-bold" style="width:9%;">Rate</th>
            <th scope="col" class="font-weight-bold" style="width:5%;">Actions</th>
          </tr>
        </thead>
        <tbody>

          @foreach ($payRates as $payRate)
          <tr>
            <th scope="row">
              {{ $payRate->id }}
            </th>
            <td>
              {{ optional($payRate->customer)->name ?? '- None -' }}
            </td>
            <td>
              <a href="{{ route('payrates.show', ['payRate' => $payRate->id ]) }}">
                {{ $payRate->description }}
              </a>
            </td>
            <td>
              € {{ $payRate->rate }} / hr
            </td>
            <td>
              <div class="d-flex justify-content-around align-items-center">
                <a href="{{ route('payrates.edit', ['payRate' => $payRate->id]) }}">
                  <span class="mdi mdi-pencil"></span>
                </a>
                <form action="{{ route('payrates.destroy', ['payRate' => $payRate->id]) }}" method="POST" class="m-0 p-0">
                  @csrf
                  @method('DELETE')
                  <span class="btn-delete-pay-rate" style="cursor: pointer;">
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


@push('scripts')
<script>
  $('.btn-delete-pay-rate').on('click', function (event) {

    window.deletePayRate = () => {
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
        <h5 class="modal-title" id="exampleModalLabel">Confirm delete pay rate</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        Do you really want to delete this pay rate?<br>
        This action cannot be undone!
      </div>
      <div class="modal-footer d-flex justify-content-between align-items-center">
        <button type="button" class="btn btn-outline-danger" onclick="deletePayRate()">Delete this pay rate</button>
        <button type="button" class="btn btn-success" data-dismiss="modal">Go back to safety</button>
      </div>
    </div>
  </div>
</div>
@endpush
