@extends('layouts.admin')

@section('title')
    <b>Deposit Slips</b>

@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Reservation ID</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($reservation as $reservations)
		    @foreach($reservations->messages as $messages)
		<tr>
			<td><b>{{$messages->id}}</b></td>
			<td>{{$messages->reservation_id}}</td>
            <td>
            @if (File::exists(public_path('bank/'.$messages->reservation_id.'.jpg')))
                 <img src="{{ asset('bank/'.$messages->reservation_id.'.jpg')}}" width="600" height="500"  >
            @endif
			<td>
			    <a href="{{action('AdminController@updateReservation', $messages->reservation_id)}}" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-thumbs-up"></span> Approve</a><br>
			</td>
			</tr>
		@endforeach
		@endforeach
		</tbody>
		<tfoot>
{{--
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
--}}
		</tfoot>

		</table>
@stop