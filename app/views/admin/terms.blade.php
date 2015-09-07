@extends('layouts.admin')

@section('title')
    <b>Terms and Conditions</b>
    <a href="{{action('AdminController@addTerm')}}" class="btn btn-info pull-right btn-lg "><span class="glyphicon glyphicons-pencil"></span> Add</a>
@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>Number</th>
			<th>Title</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($term as $terms)
		<tr>
			<td><b>{{$terms->number}}</b></td>
			<td>{{$terms->title}}</td>
			<td>{{$terms->description}}</td>
			<td>
			<a href="{{action('AdminController@updateTerm',$terms->id)}}" class="btn btn-warning btn-sm"><span class="glyphicon glyphicons-pencil"></span> Update</a>
			<a href="{{action('AdminController@deleteTerm',$terms->id)}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicons-remove"></span> Delete&nbsp;</a>

			</td>
			</tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$term->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop