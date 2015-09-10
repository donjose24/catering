@extends ('layouts.admin')

@section('title')
  <a href="{{ action('Settings\AgentsController@index') }}"><i class="fa fa-arrow-left"></i> Back to Agents</a>

  <h1 class="page-header"><i class="fa fa-user"></i> Add Agent Record</h1>
@stop

@section ('body')

  {{ Form::open(['action' => 'Settings\AgentsController@store', 'role' => 'form']) }}
  <div class="row">
    <div class="form-group {{ $errors->has('first_name') ? 'has-error' : ''}} col-md-4">
      {{ Form::label('first_name', 'First Name', array('class' => 'control-label')) }}
      {{ Form::text('first_name', null, array('class' => 'form-control')) }}
      @if ($errors->has('first_name'))
        <span class="help-block">{{$errors->first('first_name')}}</span>
      @endif
    </div>
    <div class="form-group {{ $errors->has('last_name') ? 'has-error' : ''}} col-md-4">
      {{ Form::label('last_name', 'Last Name') }}
      {{ Form::text('last_name', null, array('class' => 'form-control')) }}
      @if ($errors->has('last_name'))
        <span class="help-block">{{$errors->first('last_name')}}</span>
      @endif
    </div>
    <div class="form-group {{ $errors->has('employee_number') ? 'has-error' : ''}} col-md-4">
      {{ Form::label('employee_number', 'Employee Number') }}
      {{ Form::text('employee_number', null, array('class' => 'form-control')) }}
      @if ($errors->has('employee_number'))
        <span class="help-block">{{$errors->first('employee_number')}}</span>
      @endif
    </div>
  </div>
    <div class="form-group"{{ $errors->has('notes') ? 'has-error' : ''}} >
      {{ Form::label('notes', 'Notes') }}
      {{ Form::textarea('notes', null, array('class' => 'form-control')) }}
      @if ($errors->has('notes'))
        <span class="help-block">{{$errors->first('notes')}}</span>
      @endif
    </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
