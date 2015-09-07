@extends('layouts.admin')

@section('title')
    <b>Messages</b>
@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Title</th>
			<th>Description</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($contact as $contacts)
		<tr>
			<td><b>{{$contacts->id}}</b></td>
			<td>{{$contacts->name}}</td>
			<td>{{$contacts->title}}</td>
			<td>{{$contacts->description}}</td>
			<td><a href="{{action('AdminController@deleteMessage',$contacts->id)}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicons-remove"></span> Delete</a></td>
			</tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$contact->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop