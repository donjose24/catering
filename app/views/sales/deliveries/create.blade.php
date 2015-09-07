
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\DeliveriesController@index') }}"><i class="fa fa-arrow-left"></i> Back to Deliveries</a>
  <h1 class="page-header"><i class="fa fa-user"></i> Delivery Receipt
    <br><small>{{ $quotation->client->customer_name }} : {{ $quotation->client->street_address }}, {{ $quotation->client->city }}</small>
  </h1>

  {{ Form::open(['action' => ['Sales\DeliveriesController@store'], 'files' => true, 'role' => 'form']) }}

      {{ Form::hidden('quotation_id', $quotation->id) }}
      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('so_number', 'SO#:') }}
          {{ Form::text('so_number', $quotation->so_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
      </div>
      <div class="row">
        <div class="form-group {{ $errors->has('reference_number') ? 'has-error' : ''}} col-md-4">
          {{ Form::label('reference_number', 'Ref#:') }}
          {{ Form::text('reference_number', null, ['class' => 'form-control']) }}
          @if ($errors->has('reference_number'))
            <span class="help-block">{{$errors->first('reference_number')}}</span>
          @endif
        </div>         
        <div class="form-group {{ $errors->has('delivered_by') ? 'has-error' : ''}} col-md-4">
          {{ Form::label('delivered_by', 'Delivered By') }}
          {{ Form::text('delivered_by', null, ['class' => 'form-control']) }}
          @if ($errors->has('delivered_by'))
            <span class="help-block">{{$errors->first('reference_number')}}</span>
          @endif
        </div>    
          {{ Form::label('', 'Date') }}
        <div class="input-append date input-group col-md-4" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
          <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" type="text" value="{{ date('Y-m-d') }}" readonly="" name="delivery_date">
        </div>
      </div>
        @if ($errors->has('item_qty'))
          <div class="{{ $errors->has('item_qty') ? 'has-error' : ''}}">
              <span class="help-block">{{$errors->first('item_qty')}}</span>
          </div>
        @endif
    <div class='row'>
        <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th>Model#</th>
                <th>Description</th>
                <th>Dimensions</th>
                <th>Total Qty</th>
                <th>Delivered</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($quotation->items as $item)
                @if ($item->pivot->quantity-$item->pivot->delivered_quantity > 0)
                <tr>
                  {{ Form::hidden('item_ids[]', $item->id) }}
                  <td>{{ $item->model_number }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->dimensions }}</td>
                  <td>{{ $item->pivot->quantity-$item->pivot->delivered_quantity }}</td>
                  <td>{{ Form::text('item_qtys[]', '0', ['class' => 'form-control']) }}</td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
    </div>

      <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
    {{ Form::close() }}

    <script>
      $('#dp').datepicker();
    </script>
@stop

