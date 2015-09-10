@extends('layouts.master')

@section('content')
  <div class="row">
    <div class="col-xs-4 col-xs-offset-4">
      <h1>Karolols Inventory</h1>
      {{ Form::open(array('action' => 'AuthController@postSignIn', 'role' => 'form')) }}
        <div class="form-group">
          {{ Form::label('email', 'Email Address') }}
          {{ Form::email('email', null, array('class' => 'form-control', 'autofocus')) }}
        </div>
        <div class="form-group">
          {{ Form::label('password', 'Password') }}
          {{ Form::password('password', array('class' => 'form-control')) }}
        </div>
        <button type="submit" class="btn btn-success pull-right">
          <i class="fa fa-sign-in"></i> Sign In
        </button>
      {{ Form::close() }}
    </div>
  </div>
@stop
