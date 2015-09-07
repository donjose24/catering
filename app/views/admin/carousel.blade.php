@extends('layouts.admin')

@section('title')
<b>Carousel Images</b>
   <a class='btn btn-info pull-right'data-toggle="modal" data-target="#addCarousel"><span class="glyphicon glyphicon-plus"></span> Add Carousel Image</a><br>

@stop

@section('body')
<div class="modal fade" id="addCarousel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" style = "text-align: center"><b>Add Carousel Image</b></h4>
                    </div>
                <div class="modal-body"><div class="te">
                {{Form::open(['action' => 'AdminController@addCarousel','files'=>true])}}
                     <h4><b>Upload Image:</b> </h4>{{ Form::file('image', ['required']) }}
                </div>
            </div>
            <div class="modal-footer">
                <input value="Submit" type="submit" class="btn btn-info btn-lg">
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
<table class="table table-stripe">
    <thead>
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($carousel as $carousels)
    <tr>
        <td><b>{{$carousels->id}}</b></td>
        <td>@if($carousels->img !== '')
                        {{ Form::open(['action' => ['AdminController@deleteCarousel', $carousels->id], 'class' => 'form-inline', 'files' => true, 'method' => 'delete']) }}
                           <img src="{{ asset('carousel/'.$carousels->img)}}" width="70" height="70"  >
                           <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> </button>
                        {{Form::close()}}
                        @else
                        {{ Form::open(['action' => ['AdminController@updateCarousel',$carousels->id], 'class' => 'form-inline', 'files' => true, 'method' => 'put']) }}
                           {{ Form::file('image', ['required']) }} <br>
                            <input value="Upload" type="submit" class="btn btn-info btn-xs">
                        {{Form::close()}}
                        @endif</td>
        <td><a href="{{action('AdminController@deleteCarouselTotal',$carousels->id)}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicons-remove"></span> Delete</a></td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7" style="text-align:right">
            <nav>
                <ul class="pagination">
                    {{$carousel->links();}}
                    <li></li>
                </ul>
            </nav>
        </td>
    </tr>

    </tfoot>

</table>
@stop