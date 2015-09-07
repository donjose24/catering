@extends('layouts.admin')

@section('title')
    <b>Terms and Condition - ADD</b>
@stop

@section('body')
<div class="panel panel-info" style="padding-left: 5px">

@if($errors->has('warning'))
    <div class="alert alert-danger" role="alert">{{$errors->first('warning')}}</div>
@endif


    {{Form::open(['action' => ['AdminController@addTerm2']])}}


        {{Form::label('number','Number: ')}}
        {{Form::number('number','',['class' => 'form-control','required'])}}

        {{Form::label('title','Title: ')}}
        {{Form::text('title','',['class' => 'form-control','required'])}}

        {{Form::label('desc','Description: ')}}
        {{Form::textarea('desc','',['class' => 'form-control','required'])}}

        <button type="submit" class="form-control btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Add</button>
    {{Form::close()}}
    </div>
@stop