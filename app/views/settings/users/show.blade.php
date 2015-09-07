@extends ('layouts.master')

@section ('content')
  <a href="{{ action('Settings\UsersController@index') }}"><i class="fa fa-arrow-left"></i> Back to Users</a>
  <h1 class="page-header"><i class="fa fa-user"></i> {{ $user->email }}
    <div class="pull-right">
    {{ Form::open(['method' => 'delete',  'action' => ['Settings\UsersController@destroy', 'user' => $user->id]]) }}
      <div class="btn-group">
        <a href="{{ action('Settings\UsersController@edit', ['user' => $user->id]) }}" class="btn btn-warning"> <i class="fa fa-edit fa-lg"></i> Edit</a>
      </div>
        <div class="btn-group">
          <button class="btn btn-danger" type="submit"> <i class="fa fa-trash-o fa-lg"></i> Delete</button>
        </div>
      {{ Form::close() }}
    </div>
  </h1>
     <div class="form-group">
      {{ Form::label('email', 'Email Address') }}
      {{ Form::email('email', $user->email, array('class' => 'form-control', 'autofocus', 'disabled' => 'disabled')) }}
    </div>
    <div class="form-group">
      {{ Form::label('is_admin', 'Admin?') }}
      <div class="checkbox">
        <label>
          Yes
          {{ Form::checkbox('is_admin', 'is_admin', $user->is_admin, array('disabled' => 'disabled')) }}
        </label>
      </div>
    </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
