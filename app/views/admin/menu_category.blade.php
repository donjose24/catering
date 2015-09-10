@extends('layouts.admin')

@section('title')
<b>List of Categories</b>
@stop

@section('body')
<div class="modal fade" id="addCategory" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" style = "text-align: center"><b>Add Menu Category</b></h4>
                    </div>
                <div class="modal-body"><div class="te">
                {{Form::open(['action' => 'AdminController@addCategory','files'=>true])}}
                <h4><b>Category:</b> </h4> {{Form::text('name','',['class' => 'form-control'])}}
                </div>
            </div>
            <div class="modal-footer">
                <input value="Submit" type="submit" class="btn btn-info btn-lg">
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>

    <a class='btn btn-info pull-right'data-toggle="modal" data-target="#addCategory"><span class="glyphicon glyphicon-plus"></span> Add Menu Category</a><br>
<table class="table table-stripe">
    <thead>
    <tr>
        <th>Category</th>
        <th>Action</th>
    </tr>
    </thead>
    <tbody>
    @foreach($category as $categorys)
    <tr>
        <td>{{$categorys->name}}</td>
        <td><a href="{{action('AdminController@deleteCategory',$categorys->id)}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove"></span> Delete</a></td>
    </tr>
    @endforeach
    </tbody>
    <tfoot>
    <tr>
        <td colspan="7" style="text-align:right">
            <nav>
                <ul class="pagination">
                    {{$category->links();}}
                    <li></li>
                </ul>
            </nav>
        </td>
    </tr>

    </tfoot>

</table>
@stop