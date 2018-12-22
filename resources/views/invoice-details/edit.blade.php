@extends('layoutcomponents.master')

@section('content')
<div class="row">
    <div class="col-6 offset-3">
        <form action="{{ route('invoicedetails.update', ['invoice' => $invoice->id, 'details' => $details->id], false) }}" method="POST" class="p-0 m-0">
            @csrf
            @method('PATCH')
            <div class="card">

                <div class="card-header">
                    <h5 class="card-title m-b-0">Add details to invoice #{{ $invoice->id }}</h5>
                </div>

                <div class="card-body border-top">
                    <div class="row">

                        <div class="col-2">
                            <div class="form-group">
                                <label>Time</label>
                                <input type="text" name="time" class="form-control" placeholder="HH:MM" value="{{ old('time') ?? $details->formatted_time }}">
                            </div>
                        </div>

                        <div class="col-5">
                            <div class="form-group">
                                <label>Rate</label>
                                <select name="rate_id" class="form-control">

                                    @foreach ($rates as $rate)
                                        {{-- If we have old input, use it. If we don't have old input, use the current rate that is attached to this invoice detail --}}
                                        <option value="{{ $rate->id }}"{{ old('rate_id') == $rate->id || is_null(old('rate_id')) && $details->rate->id == $rate->id ?' selected': null  }}>
                                            {{ $rate->description }} (€{{ $rate->rate }}/h)
                                        </option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Tax</label>
                                <div class="input-group">
                                    <input type="text" name="tax_percentage" class="form-control" placeholder="Tax" value="{{ old('tax_percentage') ?? $details->tax_percentage }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>
                                    Sub total
                                    <small class="text-muted">(calculated)</small>
                                </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">€</span>
                                    </div>
                                    <input type="text" id="sub_total_calculated" class="form-control" readonly value="{{ $details->sub_total }}">
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row">

                        <div class="col-9">
                            <div class="form-group">
                                <label>Description</label>
                                <input type="text" name="description" class="form-control" value="{{ old('description') ?? $details->description }}">
                            </div>
                        </div>

                        <div class="col-3">
                            <div class="form-group">
                                <label>Work date</label>
                                <input type="text" name="task_performed_date" class="form-control" autocomplete="off" value="{{ old('task_performed_date') ?? $details->task_performed_date->toDateString() }}">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card-footer border-top d-flex justify-content-between align-items-center">
                    <a href="{{ route('invoices.show', ['invoice' => $invoice->id]) }}" class="btn btn-secondary">Back to invoice</a>
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
        $('[name="task_performed_date"]').datepicker({
            autoclose: true,
            todayHighlight: true,
            orientation: 'bottom',
            format: 'yyyy-mm-dd'
        });
        $('[name="time"]').inputmask('99:99');


        $('[name="time"], [name="rate_id"], [name="tax_percentage"]').on('input change', () => {
            let time = $('[name="time"]').val();
            let rate = $('[name="rate_id"] option:selected').text().trim();
            let tax  = $('[name="tax_percentage"]').val() || 0;
            let hours;
            let minutes;
            let subTotal;

            if (!time) {
                return $('#sub_total_calculated').val('-');;
            }

            rate = parseFloat(/\(€(.*)\/h\)/g.exec(rate)[1]);

            time = time.replace(':', '.').replace(/\_/g, '0');

            minutes = /.*\.(\d{2})/.exec(time)[1];
            hours = /(\d{2})\..*/.exec(time)[1];

            time = parseFloat([hours, '.', minutes / 0.6].join(''));

            subTotal = (time * rate).toFixed(2);

            $('#sub_total_calculated').val(subTotal);
        });

        $('[name="time"]').on('change', function() {
            let oldVal = $(this).val();
            $(this).val(
                oldVal.replace(/\_/g, '0')
            );
        });

    </script>
@endpush
