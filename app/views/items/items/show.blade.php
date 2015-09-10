@extends ('layouts.admin')

@section ('body')
  <a href="{{ action('Items\ItemsController@index') }}"><i class="fa fa-arrow-left"></i> Back to Items</a>
  <h1 class="page-header"><i class="fa fa-client"></i> {{ $item->model_number }} <small> {{ $item->description }} </small>
    <div class="pull-right">
    {{ Form::open(['method' => 'delete',  'action' => ['Items\ItemsController@destroy', 'item' => $item->id]]) }}
      <div class="btn-group">
        <a href="{{ action('Items\ItemsController@edit', ['item' => $item->id]) }}" class="btn btn-warning"> <i class="fa fa-edit fa-lg"></i> Edit</a>
      </div>
      <div class="btn-group">
        <button class="btn btn-danger" type="submit"> <i class="fa fa-trash-o fa-lg"></i> Delete</button>
      </div>
    {{ Form::close() }}
    </div>
  </h1>
     <div class="row">
      <div class="form-group col-md-6">
        {{ Form::label('model_number', 'Model Number', array('class' => 'control-label')) }}
        {{ Form::text('model_number', $item->model_number, array('class' => 'form-control', 'disabled' => 'disabled')) }}
      </div>
      <div class="form-group col-md-6">
        {{ Form::label('dimensions', 'Dimensions') }}
        {{ Form::text('dimensions', $item->dimensions, array('class' => 'form-control', 'disabled' => 'disabled')) }}
      </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('average_price', 'Average Price') }}
          {{ Form::text('average_price', $item->average_price, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group col-md-4">
          {{ Form::label('alert_quantity', 'Alert Quantity') }}
          {{ Form::text('alert_quantity', $item->alert_quantity, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group col-md-4">
          {{ Form::label('uom', 'Unit of Measure') }}
          {{ Form::text('uom', $item->uom, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('itemtype_id', 'Item Type') }}
        {{ Form::text('itemtype_id', $item->itemtype->name, array('class' => 'form-control', 'disabled' => 'disabled')) }}
      </div>
      <div class="form-group">
            <center><img src="{{ asset('equipments/'.$item->image)}}" width="300" height="300"  ></center>
      </div>
      <div class="form-group">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', $item->description, array('class' => 'form-control', 'disabled' => 'disabled')) }}
      </div>

@stop
