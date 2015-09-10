@extends('layouts.admin')

@section('title')
    <b>List of Messages</b>

@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			
			<th>Reservation ID</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($reservation as $reservations)
		    
		
            @if (File::exists(public_path('cancellation/'.$reservations->id.'.jpg')))
               <tr>
			<td>{{$reservations->id}}</td>
            <td> 
                 <img src="{{ asset('cancellation/'.$reservations->id.'.jpg')}}" width="600" height="500"  >
           
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