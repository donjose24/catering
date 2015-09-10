@extends('layouts.admin')

@section('title')
    <b>Terms and Condition - {{ucwords($term->title)}}</b>
@stop

@section('body')
<div class="panel panel-info" style="padding-left: 5px">

@if(isset($warning))
    <div class="alert alert-danger" role="alert">{{$warning }}</div>
@endif


    {{Form::open(['action' => ['AdminController@editTerm']])}}
        {{Form::hidden('id',$term->id)}}

        {{Form::label('number','Number: ')}}
        {{Form::number('number',$term->number,['class' => 'form-control'])}}

        {{Form::label('title','Title: ')}}
        {{Form::text('title',$term->title,['class' => 'form-control'])}}

        {{Form::label('desc','Description: ')}}
        {{Form::textarea('desc',$term->description,['class' => 'form-control'])}}

        <button type="submit" class="form-control btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Update</button>
    {{Form::close()}}
    </div>
@stop