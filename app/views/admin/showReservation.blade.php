@extends('layouts.admin')
@section('modal')
    <div class="modal fade" id="updateMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" style = "text-align: center"><b>UPDATE RESERVATION</b></h4>
                        </div>
                     {{Form::open(['action' => 'AdminController@updateMenuReservation' , 'method' => 'post'])}}
                     {{Form::hidden('id',$reservation->id)}}
                    <div class="modal-body">
                        <div class="te">
                        <div role="tabpanel">
                            <table class="table table-striped">
                                @foreach($reservation->items as $items)
                                     
                                     <tr>
                                          <input type="hidden" name="invId[]" value="{{$items->id}}">
                                          <input type="hidden" name="pricey[]" value="{{$items->average_price}}">
                                          <td><input type="text" name="model[]" value ="{{$items->model_number}}" class="form-control" disabled></td>
                                          <td>{{Form::number('quantity[]',$items->pivot->qty,['class' => 'form-control', 'placeholder' => 'Qty'])}}</td>
                                     </tr>
                                @endforeach
                            </table>
                        <hr>
                            <ul class="nav nav-tabs" role="tablist" id="myTab">
                               @for($x=1; $x<=$diff; $x++)
                                    <li role="presentation"><a href="#day{{$x}}" aria-controls="day{{$x}}" role="tab" data-toggle="tab">Day {{$x}}</a></li>
                               @endfor
                            </ul>
                             <div class="tab-content">
                                @for($x=1; $x<=$diff; $x++)
                                  <div role="tabpanel" class="tab-pane fade in @if($x==1)active @endif" id="day{{$x}}">
                                    <h1>Day {{$x}}</h1>
                                    <h4><b>Include Menu:</b></h4>

                              <div class="panel panel-default">
                                 <div class="panel-heading">
                                     <h3 class="panel-title">Packages</h3>
                                 </div>
                                 <div class="panel-body">
                                 <fieldset class="group">
                                 @foreach($packages as $package)
                                     <ul class="checkbox">
                                         <li>
                                             <input name="package{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$package->id}}"> {{$package->name}}
                                         </li>
                                     </ul>
                                 @endforeach
                                 </fieldset>
                                 </div>
                               </div>

                             @foreach($categories as $category)
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{ucwords($category->name)}}</h3>
                                </div>
                                <div class="panel-body">
                                <fieldset class="group">
                                @foreach(Menu::where('scat','=',$category->name)->get() as $menu)
                                    <ul class="checkbox">
                                        <li>
                                            <input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$menu->id}}"> {{$menu->name}}
                                        </li>
                                    </ul>
                                @endforeach
                                </fieldset>
                                </div>
                              </div>
                             @endforeach
                        </div>
                    @endfor</div></div></div></div>

                    <div class="modal-footer">
                       <button type="submit " class="btn btn-primary">Save</button>
                    </div>
                    {{Form::close()}}
            </div> {{--modal body--}}
        </div>
    </div>



{{--ANOTHER MODAL--}}
<div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">EDIT RESERVATION ({{$reservation->id}})</h4>

            </div>
            <div class="modal-body">
                <div class="te">
                     {{Form::open(['action' => 'catering\ReservationsController@changeStatus'])}}
                    
                    {{Form::hidden('id',$reservation->id,['class' => 'form-control','required'])}}

                    <label class="control-label">First Name:</label>
                    {{ Form::text('first_name',$reservation->first_name,['class' => 'form-control', 'placeholder' => 'First Name', 'autofocus' => 'true', 'required']) }}

                    <label class=" control-label">Last Name:</label>
                    {{ Form::text('last_name',$reservation->last_name,['class' => 'form-control', 'placeholder' => 'Last Name', 'required']) }}

                    <label class="control-label">Address:</label>
                    {{ Form::text('client_address',$reservation->client_address,['class' => 'form-control', 'placeholder' => 'Address', 'required']) }}

                   <label class=" control-label">Contact:</label>
                   {{ Form::text('contact',$reservation->contact,['class' => 'form-control', 'placeholder' => 'Contact', 'required']) }}

                    <label class="control-label">Date From:</label>
                    <input type="date"  name="reservation_start" class="form-control" required="required" />
                    <label class="control-label">To:</label>
                    <input type="date"  name="reservation_end" class="form-control" required="required" />

                     <label class="control-label">Motif:</label>
                     {{ Form::text('motif',$reservation->motif,['class' => 'form-control', 'placeholder' => 'Event Motif', 'required']) }}

                  <label class="control-label">Type Of Occasion:</label>
                  {{ Form::text('event',$reservation->event,['class' => 'form-control', 'placeholder' => 'Occassion Type', 'required']) }}
                     <label class="control-label">Number of Person:</label>
                    {{ Form::text('pax',$reservation->pax,['class' => 'form-control', 'placeholder' => 'Number of Person', 'required']) }}

                 <label class="control-label">Time From:</label>
                 <input type="time" name="event_start" class="tcal form-control" required="required" />

                 <label class=" control-label">To:</label>
                 <input type="time" name="event_end" class="tcal form-control" required="required" />

                    {{Form::label('venue_address','Event Address:')}}
                    {{Form::text('venue_address',$reservation->venue_address,['class' => 'form-control','required'])}}
                <hr>
                    {{Form::label('id','Status:')}}
                    {{Form::select('status', array('Approved' => 'Approve', 'Declined' => 'Decline','Payment Pending' => 'Payment Pending'), $reservation->status,['class'=>'form-control'])}}

                    <label class="control-label">Payment Method:</label>
                     {{ Form::text('payment_method',$reservation->payment_method,['class' => 'form-control', 'placeholder' => 'Method of Payment', 'required']) }}

                       <label class="control-label">Payment Mode:</label>
                     {{ Form::text('payment_mode',$reservation->payment_mode,['class' => 'form-control', 'placeholder' => 'Mode of Payment', 'required']) }}

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-edit"></span> Update</button>
                 {{Form::close()}}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
@stop
@section('title')
    <b>Reservation Dashboard</b>
    {{Form::open(['action' => ['AdminController@deleteReservation',$reservation->id]])}}
        <input style="margin-right: 5px; margin-left: 5px" onclick="return confirm('Are you sure you want to do that?');" id="deleteForm" type="submit" class="pull-right btn btn-danger btn-lg" value="Delete">
    {{Form::close()}}
       <a href="#" data-target="#update" data-toggle='modal' class="btn btn-warning btn-lg pull-right "><span class="glyphicon glyphicon-pencil"></span> Update</a>

@stop

@section('body')

 <div class="panel panel-default" >

 	<fieldset>
 		<legend>
 			<h3 style="text-align:center;">Reservation Summary</h3>


 		</legend>
 		<br>
 		<br>
 	<div class="panel-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Reservation ID:</label>
        <div class="col-lg-3">
            {{$reservation->id}}
        </div>
        <label class="col-lg-3 control-label">Date Applied:</label>
        <div class="col-lg-3">
            {{$date3    }}
        </div>
    </div>
    <br>
    <div class="form-group">
        <label class="col-lg-3 control-label">Full Name:</label>
        <div class="col-lg-3">
            {{$reservation->first_name . " " .$reservation->last_name}}
        </div>
        <label class="col-md-3 control-label">Contact:</label>
        <div class="col-lg-3">
            {{$reservation->contact}}
        </div>
    </div>
    <br>
    <div class="form-group">
        <label class="col-lg-3 control-label">Your Address:</label>
        <div class="col-lg-8">
            {{$reservation->client_address}}
        </div>
    </div>
    <br>
    <hr>
    <div class="form-group">
        <label class="col-lg-3 control-label">Occassion:</label>
        <div class="col-lg-3">
            {{$reservation->event}}
        </div>
         <label class="col-lg-3 control-label">Motif:</label>
         <div class="col-lg-3">
             {{$reservation->motif}}
         </div>
    </div>
    <br>
    <br>
    <div class="form-group">
        <label class="col-lg-2 control-label">Cater From:</label>
        <div class="col-lg-4">
            {{$date1}}
        </div>
         <label class="col-lg-2 control-label">To:</label>
         <div class="col-lg-4">
             {{$date2}}
         </div>
    </div>
    <br>
    <div class="form-group">
        <label class="col-lg-3 control-label">Event Address:</label>
        <div class="col-lg-8">
            {{$reservation->venue_address}}
        </div>
    </div>
    </div>{{--panel--}}
     <hr>
  <a href="#" data-target="#updateMenu" data-toggle='modal' class="btn btn-info btn-lg pull-right "><span class="glyphicon glyphicon-edit"></span> Update Order</a>

      <table class="table table-striped">
         <th>Day #</th>
         <th>Dish</th>
         <th>Price x Number of Person</th>
         <th>Total</th>
         <tbody>

        @foreach($reservation->items as $items)
        <tr>
                <td>Equipment</td>
                <td>{{$items->model_number}}</td>
                <td>{{$items->average_price . " x " . $items->pivot->qty}}</td>
                <td>{{$items->average_price * $items->pivot->qty}}</td>
</tr>
                      @endforeach
           @foreach($reservation->menus as $menus)

                      <tr>
                          <td>Day {{$menus->pivot->day}}</td>
                          <td>{{$menus->name}}</td>
                          @if($menus->pivot->package)
                              <td>Included in Package</td>
                          @else
                              <td>{{$menus->price . " x " . $reservation->pax}}</td>
                              <td>{{$menus->price * $reservation->pax}}</td>
                          @endif

                      </tr>
                      @endforeach
         </tbody>
         <tfoot>

<!--
            @if($reservation->payment_mode == 'Down Payment')
                <tr><td colspan="4" class="pull-left"><b>Amount Paid:</b> {{round($reservation->net_total/2,2)}}</td></tr>
                <tr><td colspan="4" class="pull-left"><b>Remaining Balance:</b> {{round($reservation->net_total/2,2)}}</td></tr>
                 @endif
                 <tr><td colspan="4" class="pull-left"><b>Grand Total:</b> {{$reservation->net_total}}</td></tr> -->

				@if($reservation->amount_paid == $reservation->net_total)
					<tr><td colspan="4" class="pull-left"><b>Status:</b>Fully Paid</td></tr>	
				@else
					<tr><td colspan="4" class="pull-left"><b>Status:</b>Not Yet Fully Paid</td></tr>
				@endif

            @if($reservation->payment_mode == 'Down Payment')
                <tr><td colspan="4" class="pull-left"><b>Amount Paid:</b> {{number_format($reservation->amount_paid,2)}}</td></tr>
                <tr><td colspan="4" class="pull-left"><b>Remaining Balance:</b> {{number_format($reservation->net_total - $reservation->amount_paid,2)}}</td></tr>
                 @endif
			<tr><td colspan="4" class="pull-left"><b>Grand Total:</b> {{number_format($reservation->net_total)}}</td></tr>


         </tfoot>
      </table>
    <hr>

            <div class="form-group">
                 <label class="col-lg-3 control-label">Payment Mode:</label>
                 <div class="col-lg-3">
                     {{$reservation->payment_mode}}
                 </div>
                 <label class="col-lg-3 control-label">Payment Method:</label>
                 <div class="col-lg-3">
                     {{$reservation->payment_method}}
                 </div>

             </div>


             <br> <br> <br>
 <div class="form-group">
                 <label class="col-lg-3 control-label">Status:</label>
                 <div class="col-lg-3">
                      {{$reservation->status}}
                 </div>
            </div>


</fieldset>
 </div>
 @if($reservation->status == 'Event End')
    <a href="{{action('AdminController@SI_generate',$reservation->id)}}" target = "blank" class="btn btn-lg btn-info"><i class="glyphicon glyphicon-signal"></i> Sales Invoice</a>
    <br><br>
     {{Form::open(['action' => 'AdminController@payAmount'])}}
     {{Form::hidden('id',$reservation->id)}}
     <h4>Pay Amount:</h4>
         <div class="input-group">
           <span class="input-group-addon" id="basic-addon1"> &#8369;</span>
           <input name="amount" type="text" class="form-control" placeholder="0.00" aria-describedby="basic-addon1" required>
         </div>
        <button type="submit" class="btn btn-default" target = "blank"><span class="glyphicon glyphicon-triangle-right"></span> Submit Payment</button>
     {{Form::close()}}
@endif
@stop
