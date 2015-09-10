@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\DeliveriesController@index') }}"><i class="fa fa-arrow-left"></i> Back to Deliveries</a>
  <h1 class="page-header"><i class="fa fa-user"></i> Delivery Receipt
    <br><small>{{ $receiving->purchase->supplier->supplier_name }} : {{ $receiving->purchase->supplier->street_address }}, {{ $receiving->purchase->supplier->city }}</small>
  </h1>

      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('si_number', 'SI#:') }}
          {{ Form::text('so_number', $receiving->purchase->si_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('reference_number', 'Ref#:') }}
          {{ Form::text('reference_number', $receiving->reference_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
        <div class="form-group col-md-4">
          {{ Form::label('delivered_by', 'Delivered By') }}
          {{ Form::text('delivered_by', $receiving->received_by, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
        {{ Form::label('', 'Date')}}
        <div class="input-append date input-group col-md-4" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
          <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" type="text" value="{{ $receiving->date }}" readonly="" name="delivery_date">
        </div>    
      </div>

    <div class='row'>
        <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th>Model#</th>
                <th>Description</th>
                <th>Dimensions</th>
                <th>Delivered</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($receiving->items as $item)
                <tr>
                  <td>{{ $item->model_number }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->dimensions }}</td>
                  <td>{{ $item->pivot->quantity }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>


@stop

