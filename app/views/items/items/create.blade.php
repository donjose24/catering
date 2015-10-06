@extends ('layouts.admin')

@section ('body')
  <a href="{{ action('Items\ItemsController@index') }}"><i class="fa fa-arrow-left"></i> Back to Items</a>

  @include('errors')

  <h1 class="page-header"><i class="fa fa-user"></i> Add Item Record</h1>


  {{ Form::open(['action' => 'Items\ItemsController@store', 'role' => 'form','files'=>true]) }}
         <div class="row">
      <div class="form-group {{ $errors->has('model_number') ? 'has-error' : ''}} col-md-6">
        {{ Form::label('model_number', 'Model Number', array('class' => 'control-label')) }}
        {{ Form::text('model_number', null, array('class' => 'form-control')) }}
        @if ($errors->has('model_number'))
          <span class="help-block">{{$errors->first('model_number')}}</span>
        @endif
      </div>
      <div class="form-group {{ $errors->has('dimensions') ? 'has-error' : ''}} col-md-6">
        {{ Form::label('dimensions', 'Dimensions') }}
        {{ Form::text('dimensions', null, array('class' => 'form-control')) }}
        @if ($errors->has('dimensions'))
          <span class="help-block">{{$errors->first('dimensions')}}</span>
        @endif
      </div>
    </div>
    <div class="row">
        <div class="form-group {{ $errors->has('average_price') ? 'has-error' : ''}} col-md-4">
          {{ Form::label('average_price', 'Average Price') }}
          {{ Form::text('average_price', null, array('class' => 'form-control')) }}
          @if ($errors->has('average_price'))
          <span class="help-block">{{$errors->first('average_price')}}</span>
        @endif
        </div>
        <div class="form-group {{ $errors->has('alert_quantity') ? 'has-error' : ''}} col-md-4">
          {{ Form::label('alert_quantity', 'Alert Quantity') }}
          {{ Form::text('alert_quantity', null, array('class' => 'form-control')) }}
          @if ($errors->has('alert_quantity'))
          <span class="help-block">{{$errors->first('alert_quantity')}}</span>
        @endif
        </div>
        <div class="form-group {{ $errors->has('uom') ? 'has-error' : ''}} col-md-4">
          {{ Form::label('uom', 'Unit of Measure') }}
          {{ Form::text('uom', null, array('class' => 'form-control')) }}
          @if ($errors->has('uom'))
          <span class="help-block">{{$errors->first('uom')}}</span>
        @endif
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('itemtype_id', 'Item Type') }}
        {{ Form::select('itemtype_id', $itemtypes, null, array('class' => 'form-control')) }}
      </div>

       <div class="form-group">
         {{ Form::label('image', 'Upload Image') }}
         {{ Form::file('image', ['required']) }}
       </div>

      <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
        {{ Form::label('description', 'Description') }}
        {{ Form::textarea('description', null, array('class' => 'form-control')) }}
        @if ($errors->has('description'))
          <span class="help-block">{{$errors->first('description')}}</span>
        @endif
      </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
