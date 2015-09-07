@extends ('layouts.master')

@section ('content')
  <a href="{{ action('Settings\UsersController@show', ['user' => $user->id]) }}"><i class="fa fa-arrow-left"></i> Back to User</a>
  <h1 class="page-header"><i class="fa fa-user"></i> Edit User</h1>
  {{ Form::model($user, ['method' => 'put', 'action' => ['Settings\UsersController@update', $user->id], 'role' => 'form']) }}
    <div class="form-group">
      {{ Form::label('email', 'Email Address') }}
      {{ Form::email('email', null, array('class' => 'form-control', 'autofocus')) }}
    </div>
    <div class="form-group">
      {{ Form::label('new_password', 'Password') }}
      {{ Form::password('new_password', array('class' => 'form-control')) }}
    </div>
    <div class="form-group">
      {{ Form::label('is_admin', 'Admin?') }}
      <div class="checkbox">
        <label>
          Yes
          {{ Form::checkbox('is_admin', true) }}
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
