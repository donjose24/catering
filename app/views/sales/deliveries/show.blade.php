
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\DeliveriesController@index') }}"><i class="fa fa-arrow-left"></i> Back to Deliveries</a>
  <h1 class="page-header"><i class="fa fa-user"></i> Delivery Receipt
    <br><small>{{ $delivery->quotation->client->customer_name }} : {{ $delivery->quotation->client->street_address }}, {{ $delivery->quotation->client->city }}</small>
  </h1>

  {{ Form::open(['action' => ['Sales\DeliveriesController@store'], 'files' => true, 'role' => 'form']) }}

      {{ Form::hidden('quotation_id', $delivery->quotation->id) }}
      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('so_number', 'SO#:') }}
          {{ Form::text('so_number', $delivery->quotation->so_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('reference_number', 'Ref#:') }}
          {{ Form::text('reference_number', $delivery->reference_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
        <div class="form-group col-md-4">
          {{ Form::label('delivered_by', 'Delivered By') }}
          {{ Form::text('delivered_by', $delivery->delivered_by, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
        {{ Form::label('', 'Date')}}
        <div class="input-append date input-group col-md-4" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
          <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" type="text" value="{{ $delivery->delivery_date }}" readonly="" name="delivery_date">
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
              @foreach ($delivery->items as $item)
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

      <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
    {{ Form::close() }}
@stop

