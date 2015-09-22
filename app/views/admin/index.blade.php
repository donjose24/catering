@extends('layouts.admin')

@section('title')
    <b>Reservation Dashboard</b>
@stop

@section('body')
<a href="{{action('AdminController@addReservation')}}" class="pull-right btn btn-success btn-lg"><span class="fa fa-plus"></span> Add Reservation</a>

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Date</th>
			<th>Reservation Date</th>
			<th>Name</th>
			<th>Contact No.</th>
			<th>Status</th>
			<th>Action</th>
		</tr>	
		</thead>
		<tbody>
		@foreach($reservation as $reservations)
		<tr>
			<td><b>{{$reservations->id}}</b></td>
			<td>{{$reservations->date_request}}</td>
			<td>{{$reservations->reservation_start}} - {{$reservations->reservation_end}}</td>
			<td>{{$reservations->first_name . " " . $reservations->last_name}}</td>
			<td>{{$reservations->contact}}</td>
			<td>{{$reservations->status}}</td>
			<td><a href="{{action('AdminController@showReservation',$reservations->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-folder-open"></span> Details&nbsp;&nbsp;</a>
			&nbsp;&nbsp;<a href="{{action('AdminController@additionalReservation',$reservations->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span> Additional</a>
        	<br>
        	<a href="{{action('AdminController@returnReservation',$reservations->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-edit"></span> Returns</a>
            &nbsp;&nbsp;<a href="{{action('AdminController@brokenReservation',$reservations->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-trash"></span> Broken&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>

        </tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$reservation->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop