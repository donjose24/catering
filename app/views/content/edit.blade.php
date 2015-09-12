@extends('layouts.admin')

@section('title')
    <b>{{$content->title or 'Create new Content'}}</b>
@stop

@section('body')
<div class="panel panel-info" style="padding-left: 5px">

        {{Form::open(['action' => ['AdminController@storeContent']])}}
        {{Form::hidden('id',$content->id) or ''}}

        {{Form::label('title','Title: ')}}
        {{Form::text('title',$content->title or '',['class' => 'form-control'])}}

        {{Form::label('content','Content: ')}}
        {{Form::textarea('content',$content->content or '',['class' => 'form-control'])}}

        @if(isset($content))
        <button type="submit" class="form-control btn btn-primary"><span class="fa fa-edit"></span> Update</button>
        @else
        <button type="submit" class="form-control btn btn-primary"><span class="fa fa-plus"></span> Create</button>
        @endif
    {{Form::close()}}
    </div>
@stop