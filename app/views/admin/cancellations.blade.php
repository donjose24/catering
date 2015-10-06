@extends('layouts.admin')

@section('title')
    <b>List of Messages</b>

@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			
			<th>Reservation ID</th>
			<th>File</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($reservation as $reservations)
		    
		
            @if (File::exists(public_path('cancellation/'.$reservations->id.'.docx')))
               <tr>
			<td>{{$reservations->id}}</td>
            <td> 
				<a href="{{ asset('cancellation/'.$reservations->id.'.docx')}}" target="_blank">Download</a>
			<td>
			    <a href="{{action('AdminController@cancelReservation', $reservations->id)}}" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-thumbs-down"></span> Decline</a><br>
			</td>
			<td>{{$reservations->status}}</td>
			@elseif (File::exists(public_path('cancellation/'.$reservations->id.'.doc')))
				<tr>
			<td>{{$reservations->id}}</td>
            <td> 
				<a href="{{ asset('cancellation/'.$reservations->id.'.doc')}}" target="_blank">Download</a>
			<td>{{$reservations->status}}</td>
			<td>
			    <a href="{{action('AdminController@cancelReservation', $reservations->id)}}" class="btn btn-danger btn-sm" ><span class="glyphicon glyphicon-thumbs-down"></span> Decline</a><br>
			</td>
			@endif
			</tr>
		
		@endforeach
		</tbody>
		<tfoot>
		{{--<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$reservation->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>--}}

		</tfoot>

		</table>
@stop
