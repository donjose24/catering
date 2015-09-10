@extends('layouts.admin')

@section('title')
    <b>Maintenance</b>

@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Type</th>
			<th>Value</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($maintenance as $maintenances)

		<tr>
			<td><b>{{$maintenances->id}}</b></td>
			<td>{{$maintenances->name}}</td>
			<td>{{$maintenances->type}}</td>
            <td> {{$maintenances->value}}</td>
			<td>
			    <a href="{{action('AdminController@updateMaintenance', $maintenances->id)}}" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-thumbs-up"></span> Edit</a><br>
			</td>
			</tr>

		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$maintenance->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop