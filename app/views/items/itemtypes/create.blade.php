@extends ('layouts.admin')

@section ('body')
  <a href="{{ action('Items\ItemTypesController@index') }}"><i class="fa fa-arrow-left"></i> Back to Item Categories</a>

  <h1 class="page-header"><i class="fa fa-user"></i> Add Item Category Record</h1>


  {{ Form::open(['action' => 'Items\ItemTypesController@store', 'role' => 'form']) }}
        <div class="form-group {{ $errors->has('name') ? 'has-error' : ''}}">
          {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
          {{ Form::text('name', null, array('class' => 'form-control')) }}
          @if ($errors->has('name'))
            <span class="help-block">{{$errors->first('name')}}</span>
          @endif
        </div>
        <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
          {{ Form::label('description', 'Description') }}
          {{ Form::text('description', null, array('class' => 'form-control')) }}
          @if ($errors->has('description'))
            <span class="help-block">{{$errors->first('description')}}</span>
          @endif
        </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop