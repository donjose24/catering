@extends('layouts.home')

@section('modal')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Terms and Conditions</h4>
      </div>
      <div class="modal-body">
      @foreach($terms as $term)
        <h4><b>{{$term->number}}. {{$term->title}}</b></h4>
        <p>
            {{$term->description}}
        </p>
        @endforeach
        <h4><b>Cancellation Fee</b></h4>
        <p>
            You should pay the amount of {{$cancellation->value}} if you want to cancel your order or be legally punished
        </p>
      </div>
    </div>
  </div>
</div>
@stop

@section('body')
    {{ Form::open(['action' => 'catering\ReservationsController@store', 'role' => 'form']) }}

 <div class="service-wrapper">

                                        <fieldset>
                                                 <legend>
                                                     <div>
                                                         <h3>Make Reservation</h3>
                                                     </div>
                                                 </legend>



                                             {{ Form::hidden('id',$finalcode) }}
                                            {{Form::hidden('date_request', Carbon::now())}}

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">First Name:</label>
                                                     <div class="col-lg-8">
                                                    {{ Form::text('first_name','',['class' => 'form-control', 'placeholder' => 'First Name', 'autofocus' => 'true', 'required']) }}
                                                 </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Last Name:</label>
                                                     <div class="col-lg-8">
                                                      {{ Form::text('last_name','',['class' => 'form-control', 'placeholder' => 'Last Name', 'required']) }}
                                                  </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Address:</label>
                                                     <div class="col-lg-8">
                                                    {{ Form::text('client_address','',['class' => 'form-control', 'placeholder' => 'Address', 'required']) }}
                                                  </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Contact:</label>
                                                     <div class="col-lg-8">
                                                    {{ Form::text('contact','',['class' => 'form-control', 'placeholder' => 'Contact', 'required']) }}
                                                  </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Date From:</label>
                                                     <div class="col-lg-4 ">
                                                         <input type="date" name="reservation_start" class="form-control" required="required" />
                                                     </div>
                                                     <label class="col-lg-1 control-label">To:</label>
                                                      <div class="col-lg-3 col-md-3 ">
                                                           <input type="date" name="reservation_end" class="form-control" required="required" />
                                                      </div>
                                                      <br>

                                                 </div>
                                                    <div class="form-group">
                                                        <div class="col-lg-12">
                                                        @if($errors->has('reservation_start'))
                                                           {{$errors->first('reservation_start')}}
                                                           <br>
                                                        @endif
                                                        @if($errors->has('reservation_end'))
                                                            {{$errors->first('reservation_end')}}
                                                        @endif
                                                        </div>
                                                        </div>
                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Motif:</label>
                                                     <div class="col-lg-8">
                                                            {{ Form::text('motif','',['class' => 'form-control', 'placeholder' => 'Event Motif', 'required']) }}
                                                      </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Type Of Occasion:</label>
                                                     <div class="col-lg-8">
                                                            {{ Form::text('event','',['class' => 'form-control', 'placeholder' => 'Occassion Type', 'required']) }}
                                                     </div>
                                                 </div>
                                                  <div class="form-group">
                                                      <label class="col-lg-3 control-label">Number of Person:</label>
                                                      <div class="col-lg-8">
                                                             {{ Form::text('pax','',['class' => 'form-control', 'placeholder' => 'Number of Person', 'required']) }}
                                                         @if($errors->has('pax'))
                                                             {{$errors->first('pax')}}
                                                         @endif
                                                      </div>

                                                  </div>
                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Time From:</label>
                                                    <div class="col-lg-3 ">
                                                        <input type="time" name="event_start" class="tcal form-control" required="required" />
                                                    </div>

                                                    <label class="col-lg-2 control-label">To:</label>
                                                    <div class="col-lg-3 ">
                                                        <input type="time" name="event_end" class="tcal form-control" required="required" />
                                                    </div>
                                                </div>

                                                 <div class="form-group">
                                                     <label class="col-lg-3 control-label">Venue Address:</label>
                                                     <div class="col-lg-8">
                                                            {{ Form::text('venue_address','',['class' => 'form-control', 'placeholder' => 'Venue Address', 'required']) }}
                                                     </div>
                                                 </div>

                                                {{--LALALAL--}}
                                                 <div class="checkbox">
                                                     <label class="col-lg-4"></label>
                                                     <div class="col-lg-6">
                                                         <input type="checkbox" required name="condition" value="checkbox" style="width: 13px;" /><p> I agree the <a rel="facebox" data-toggle="modal" data-target="#myModal" href="#">terms and condition</a> of this site
                                                                                                                                                                                                </p> </div>
                                                 </div>

                                                 <div class="form-group">
                                                     <div class="col-lg-10 col-lg-offset-2">
                                                         <button type="cancel" class="btn btn-default" value="Cancel" style="margin-right:20px;"> Cancel</button>
                                                         <button type="submit" class="btn btn-primary" value="Reserve"> Submit</button>
                                                     </div>
                                                 </div>
                                             </fieldset>
                                         {{Form::close()}}


</div>
@stop