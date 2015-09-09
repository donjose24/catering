<<<<<<< HEAD
@extends('layouts.home')

@section('content-head')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php $index = 0 ?>
=======
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>HOME</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
            {{HTML::style('homepage/css/bootstrap.min.css')}}
            {{HTML::style('homepage/css/modern-business.css')}}
            {{HTML::style('homepage/font-awesome-4.1.0/css/font-awesome.min.css')}}
            {{HTML::style('homepage/css/style.css')}}
            {{HTML::style('homepage/css/icomoon-social.css')}}
            {{HTML::style('http://fonts.googleapis.com/css?family=Open+Sans:400,700,600,800')}}
            {{HTML::style('homepage/css/leaflet.css')}}
            {{HTML::style('homepage/css/main.css')}}
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        </head>

<body>
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Check Reservation</h4>

            </div>
            <div class="modal-body">
                <div class="te">
                    {{Form::open(['action' => 'AuthController@signIn'])}}
                   <div class="account-wall">
                        <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                            alt="">
                    </div>
                    <hr>
                    <div class="form-group">
                     <label> Username:</label>
                            <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                        <label> Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>

                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span> Sign In</button>
                 {{Form::close()}}
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    <!-- Navigation & Logo-->
    <div>
        <!-- MENU TAB -->
        <div class="mainmenu-wrapper">
	        <div class="container">
	        	<div class="menuextras">
                    <div class="extras">
                        <ul>
                            <li> <a data-toggle="modal" data-target="#login" href="#" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-thumbs-up"></span> Sign in</a></li>
                         </ul>
                    </div>
                </div>
		        <nav id="mainmenu" class="mainmenu">
                    <ul class="menu">
                        <li class=""><a href="{{url('/home')}}">Home</a></li>
                        <li class=""><a href="{{url('/equip')}}">Equipments</a></li>
                        <li class=""><a href="{{url('/menu/home')}}">Menu</a></li>
                        <li class=""><a href="{{url('/reservation')}}">Reservation</a></li>
                        <li class=""><a href="{{url('/contact')}}">Contact Us</a></li>

                    </ul>
                </nav>
			</div>
		</div>
        <!-- / MENU TAB -->

 <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
   <!-- Indicators -->
   <ol class="carousel-indicators">

     <?php $index = 0 ?>
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
         @foreach($carousel as $carousels)
             @if($index == 0)
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              @else
                  <li data-target="#carousel-example-generic" data-slide-to="<?php echo $index ?>"></li>
             @endif
            <?php $index++ ?>
         @endforeach

   </ol>
<<<<<<< HEAD
=======

>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
   <!-- Wrapper for slides -->
   <div class="carousel-inner" role="listbox">
    <?php $index = 0 ?>
     @foreach($carousel as $carousels)

         @if($index == 0)
           <div class="item active">
              <center> <img src="{{ asset('carousel/'.$carousels->img)}}" width="300" height="300"  ></center>
           </div>
         @else
            <div class="item ">
               <center> <img src="{{ asset('carousel/'.$carousels->img)}}" width="300" height="300"  ></center>
             </div>
         @endif

         <?php $index++ ?>
     @endforeach

   </div>

   <!-- Controls -->
   <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
     <span class="sr-only">Previous</span>
   </a>
   <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
     <span class="sr-only">Next</span>
   </a>
 </div>
<<<<<<< HEAD
@stop
@section('body')
=======

>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
        <!-- WELCOME-->
        <div class="container">
            <!-- Marketing Icons Section -->

        <!-- Services -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-sm-6">
                        <div class="in-press press-wired">
                            <div>
                                <h1 class="page-header">
                                    Welcome to Catering
                                </h1>
                            </div>
                            <div>
                                <p> this is a busines that cater and can provide the equipments you needs for your event. </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <div class="service-wrapper">
                            <div>
                                <h3> Check Reservation Status </h3>
                            </div>
                            <hr>
                            <div>
<<<<<<< HEAD
                                {{Form::open(['url' => 'catering/reservation/check/reservation'])}}
=======
                                {{Form::open(['url' => 'reservation/check/reservation'])}}
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
                                 {{Form::label('id','Reservation ID:')}}
                                 {{Form::text('id','',['class' => 'form-control','required'])}}

                            </div>
                            <div>
<<<<<<< HEAD
                                <input class="btn btn-block" type="submit" value="Submit">
=======
                                <input class="btn " type="submit" value="Submit">
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<<<<<<< HEAD
    </div>
@stop
    @section('scripts')
=======

    </div>

    <!-- ADD FOOTER -->
    <hr>
    <!-- Footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- Footer Navigator -->
                <div class="col-footer col-md-4 col-xs-6">
                    <h3>Navigate</h3>
                    <ul class="no-list-style footer-navigate-section">
                        <li class="active"><a href="index.php">Home</a></li>
                        <li><a href="menu.php">Menu</a></li>
                        <!-- <li><a href="equipment.php">Equipment Rentals</a></li> -->
                        <li><a href="reservation.php">Reservation</a></li>
                        <li><a href="about-us.php">About Us</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                    </ul>
                </div>

                <!-- footer Contacts -->
                <div class="col-footer col-md-5 col-xs-6">
                    <h3>Contacts</h3>
                        <p class="contact-us-details">
                        <b>Address:</b> 123 Fake Street, LN1 2ST, London, United Kingdom<br/>
                        <b>Phone:</b> +44 123 654321<br/>
                        <b>Fax:</b> +44 123 654321<br/>
                        <b>Email:</b> <a href="mailto:getintoutch@yourcompanydomain.com">getintoutch@yourcompanydomain.com</a>
                    </p>
                </div>

                <!-- Footer stay connected -->
                <div class="col-footer col-md-3 col-xs-6">
                    <h3>Stay Connected</h3>
                        <ul class="footer-stay-connected no-list-style">
                            <li><a href="#" class="facebook"></a></li>
                            <li><a href="#" class="twitter"></a></li>
                            <li><a href="#" class="googleplus"></a></li>
                        </ul>
                    </div>
                </div>

                <!-- All Rights Reserved -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="footer-copyright">&copy; All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
<<<<<<< HEAD
    @stop
=======

    <!-- Javascripts -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="js/bootstrap.min.js"></script>
    <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
    <script src="js/jquery.fitvids.js"></script>
    <script src="js/jquery.sequence-min.js"></script>
    <script src="js/jquery.bxslider.js"></script>
    <script src="js/main-menu.js"></script>
    <script src="js/template.js"></script>

	    <script src="{{asset('homepage/js/bootstrap.min.js')}}"></script>
	    <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	    <script src="{{asset('homepage/js/jquery.fitvids.js')}}"></script>
	    <script src="{{asset('homepage/js/jquery.sequence-min.js')}}"></script>
	    <script src="{{asset('homepage/js/jquery.bxslider.js')}}"></script>
	    <script src="{{asset('homepage/js/main-menu.js')}}"></script>
	    <script src="{{asset('homepage/js/template.js')}}"></script>
</body>
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
</html>
