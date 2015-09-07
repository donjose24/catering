@extends('layouts.admin')

@section('title')
    <b>{{ucwords($menu->name)}}</b>
@stop

@section('body')
            <div class="panel panel-info" style="padding-left: 5px">
                {{Form::open(['action' => ['AdminController@editMenu', $menu->id],'files'=>true])}}
                            <h4><b>Name:</b> </h4> {{Form::text('name',$menu->name,['class' => 'form-control','required'])}}
                            <h4><b>Description:</b></h4> {{Form::textarea('description',$menu->description,['class' => 'form-control','style' => 'resize: none;'])}}
                                           <h4><b>Price:</b> </h4>{{Form::number('price',$menu->price,['class' => 'form-control','required'])}}
                            <h4><b>Category:</b> </h4>
                            <h4><b>Upload Image:</b> </h4>{{ Form::file('image', ['required']) }}
               <input value="Submit" type="submit" class="btn btn-info btn-lg pull-right">

            </div>

@stop