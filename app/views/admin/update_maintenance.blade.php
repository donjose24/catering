@extends('layouts.admin')

@section('title')
    <b>Maintenance - {{ucwords($maintenance->name)." ($maintenance->type)"}}</b>
@stop

@section('body')
<div class="panel panel-info" style="padding-left: 5px">
    {{Form::open(['action' => ['AdminController@editMaintenance'],'class' => 'input-group'])}}
        {{Form::hidden('id',$maintenance->id)}}
        {{Form::label('value','Value: ')}}
        {{Form::text('value',$maintenance->value,['class' => 'form-control'])}}
        <button type="submit" class="form-control btn btn-primary"><span class="glyphicon glyphicon-edit"></span> Update</button>
    {{Form::close()}}
    </div>
@stop