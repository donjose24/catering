@extends('layouts.home')

@section('body')
<script type="text/javascript">
    window.onbeforeunload = function() {
        return "Dude, are you sure you want to leave? Think of the kittens!";
    }
</script>
 <div class="panel panel-default" >
 	<fieldset>
 		<legend>
 			<h3 style="text-align:center;">Reservation Summary</h3>
 		</legend>
    <div class="panel-body">
    <div class="form-group">
        <label class="col-md-3 control-label">Reservation ID:</label>
        <div class="col-lg-3">
            {{$reservation->id}}
        </div>
        <label class="col-lg-3 control-label">Date Applied:</label>
        <div class="col-lg-3">
            {{$reservation->date_request    }}
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
         <?php
            $vat = $reservation->net_total * 0.12;
            $sub_total = $reservation->net_total - $vat;
         ?>

         <tfoot>
            <tr><td colspan="4"></td></tr>
            <tr><td colspan="4" class="pull-left"><b>Sub Total:</b> </td><td>{{round($sub_total,2)}}</td></tr>
            <tr><td colspan="4" class="pull-left"><b>VAT amount (12%):</b> </td><td>{{round($vat,2)}}</td></tr>
            <tr><td colspan="4" class="pull-left"><b>Grand Total:</b> </td><td>{{round($reservation->net_total,2)}}</td></tr>
         </tfoot>
      </table>
    <hr>

             <div class="form-group">
                     <label class="col-lg-3 control-label">Status:</label>
                     <div class="col-lg-3">
                          {{$reservation->status}}
                     </div>
                </div>
                <br><br>
        @if($reservation->payment_method == '' || $reservation->payment_mode == '')
         {{ Form::open(['action' => ['catering\ReservationsController@attachPayment'], 'role' => 'form']) }}
                {{ Form::hidden('id', $id)  }}
                <div class="form-group">
                    <label class="col-lg-3 control-label">Payment Mode:</label>
                    <div class="col-lg-3 ">
                        {{Form::select('payment_mode', array('Full Payment' => 'Full Payment', 'Down Payment' => 'Down Payment'));}}
                    </div>
                    <label class="col-lg-3 control-label">Payment Method:</label>
                    <div class="col-lg-3 ">
                        {{Form::select('payment_method', array('Bank' => 'Bank', 'Cash' => 'Cash'));}}
                    </div>
                </div>
                <br><br><br>
         <button type="submit" class="btn btn-primary pull-right"> Submit Payment Method &gt &gt</button>
        @else
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
         <a class="btn btn-primary" href="{{ action('catering\ReservationsController@attachPdf',$reservation->id) }}" target="_blank"> View a Printer Friendly Version &gt &gt </a>
<hr>
        @if( $reservation->status == "Event End")
            @if($reservation->payment_mode = "Full Payment" || $reservation->status == "Down Payment")
             <div class="alert alert-info alert" role="alert">

                  <strong>Hi!</strong> We issue this receipt to confirm that we have processed your payment.

              <hr>

 <a class="btn btn-primary" href="{{ action('catering\ReservationsController@fullPdf',$reservation->id) }}" target="_blank"> Payment Receipt &gt &gt </a>

            </div>
            @endif
        @endif

@if($reservation->status != 'Event End')

@if (File::exists(public_path('cancellation/'.$reservation->id.'.jpg')))

   <div class="alert alert-warning alert" role="alert">
   <h5>You're request is being verified, thank you.</h5>
   </div>
  <img src="{{ asset('cancellation/'.$reservation->id.'.jpg')}}" width="600" height="500"  >

@else
    {{Form::open(['action' => ['catering\ReservationsController@attachMessageCancellation',$reservation->id],'files' => true])}}
 <div class="alert alert-warning alert" role="alert">

      <strong>Warning!</strong> When cancelling reservation you will have to pay {{$cancellation->value}} pesos for the cancellation fee and upload your deposit Slip. 
    <h5><b>Upload Deposit Slip for Cancellation:</b> </h5>{{ Form::file('image', ['required','class'=>'form-control']) }}
       
  <br>
  <button class="btn-warning"> Cancel My Reservation </button>
  
</div>
  {{Form::close()}}
@endif



@endif
         <hr>
         @if($reservation->status != 'Approved' && $reservation->status != 'Event End')
         @if($reservation->payment_method == 'Bank')
            @if (File::exists(public_path('bank/'.$reservation->id.'.jpg')))
                            {{ Form::open(['action' => ['catering\ReservationsController@deletePicture', $reservation->id], 'class' => 'form-inline', 'files' => true, 'method' => 'delete']) }}
                             <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> </button>
                             {{Form::close()}}
               <img src="{{ asset('bank/'.$reservation->id.'.jpg')}}" width="600" height="500"  >

            @else
                 {{Form::open(['action' => ['catering\ReservationsController@attachMessage',$reservation->id],'files' => true])}}
                        <h4><b>Upload Bank Slip:</b> </h4>{{ Form::file('image', ['required','class'=>'form-control']) }}
                        <button type="submit" style="margin-left: 12px" class="btn btn-info "><span class="glyphicon glyphicon-pencil"></span> Submit</button>
                 {{Form::close()}}
            @endif
             @else
             <div class="alert alert-warning alert" role="alert">
               <h5>You have chosen to pay with cash, Please settle the amount before 72 hours Thank You.</h5>
             </div>
         @endif
        
        @endif
        @endif
        {{Form::close()}}
</fieldset>
 </div>

@stop