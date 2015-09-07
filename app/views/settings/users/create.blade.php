@extends ('layouts.master')

@section ('content')
  <a href="{{ action('Settings\UsersController@index') }}"><i class="fa fa-arrow-left"></i> Back to Users</a>
  <h1 class="page-header"><i class="fa fa-user"></i> Create User</h1>
  {{ Form::open(['action' => 'Settings\UsersController@store', 'role' => 'form']) }}
    <div class="form-group">
      {{ Form::label('email', 'Email Address') }}
      {{ Form::email('email', null, array('class' => 'form-control', 'autofocus')) }}
    </div>
    <div class="form-group">
      {{ Form::label('password', 'Password') }}
      {{ Form::password('password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      {{ Form::label('is_admin', 'Admin?') }}
      <div class="checkbox">
        <label>
          Yes
          {{ Form::checkbox('is_admin', true, false) }}
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
