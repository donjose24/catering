@extends('layouts.admin')

@section('title')
    <b>{{'Create new Content'}}</b>
@stop

@section('body')

<div class="panel panel-info" style="padding-left: 5px">
        {{Form::open(['action' => ['AdminController@storeContent']])}}
        {{Form::hidden('user_id' , Auth::user()->id)}}
        {{Form::label('title','Title: ')}}
        {{Form::text('title','',['class' => 'form-control'])}}
        {{Form::label('content','Content: ')}}
        {{Form::textarea('content','',['class' => 'form-control'])}}
        <button type="submit" class="form-control btn btn-primary"><span class="fa fa-plus"></span> Create</button>
    {{Form::close()}}
</div>
@stop