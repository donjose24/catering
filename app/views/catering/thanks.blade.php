@extends('layouts.home')

@section('body')
<<<<<<< HEAD
{{ Form::open(['action' => 'Catering\ReservationsController@contactStore', 'role' => 'form']) }}
<div class="service-wrapper">
	<fieldset>
        <legend>
	         <div>
	             <h3>Contact Us</h3>
	         </div>
	     </legend>
		<p> Thank You! We love to hear this from you, getting back to you soon</p>
	</fieldset>
</div>
=======
                 {{ Form::open(['action' => 'Catering\ReservationsController@contactStore', 'role' => 'form']) }}

 <div class="service-wrapper">

                                        <fieldset>
                                                 <legend>
                                                     <div>
                                                         <h3>Contact Us</h3>
                                                     </div>
                                                 </legend>

                                                <p> Thank You! We love to hear this from you, getting back to you soon</p>
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
@stop