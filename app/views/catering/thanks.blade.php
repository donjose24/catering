@extends('layouts.home')

@section('body')
                 {{ Form::open(['action' => 'Catering\ReservationsController@contactStore', 'role' => 'form']) }}

 <div class="service-wrapper">

                                        <fieldset>
                                                 <legend>
                                                     <div>
                                                         <h3>Contact Us</h3>
                                                     </div>
                                                 </legend>

                                                <p> Thank You! We love to hear this from you, getting back to you soon</p>
@stop