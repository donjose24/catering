<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>{{Information::where('type' ,'=' , 'primary')->first()['value']}}</title>
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
        {{HTML::style('addasset/css/sweetalert.css')}}
        <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        
        <script>
            function switchDay(day, numberDays)
            {
                alert(day);
                document.getElementById("day"+day).style.display = 'block';
                for(index = 1; index <= numberDays; index++){
                    if(index == day) continue;
                    document.getElementById("day"+index).style.display = 'none';
                }
            }
        </script>
    </head>

    <body>
<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body"><div class="te"></div></div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="checkReservation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">Check Reservation</h4>
            </div>
            <div class="modal-body">
                <div class="te">
                    {{Form::open(['action' => 'catering\ReservationsController@checkReservation'])}}
                    {{Form::label('id','Reservation ID:')}}
                    {{Form::text('id','',['class' => 'form-control','required'])}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg"><span class="glyphicon glyphicon-edit"></span> Check</button>
                 {{Form::close()}}
            </div>
        </div>
    </div>
    <!-- /.modal-dialog -->
</div>
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title">User Sign-in</h4>
            </div>
            <div class="modal-body">
                <div class="te">
                    {{Form::open(['action' => 'AuthController@signIn'])}}
                   <div class="account-wall">
                        <img class="profile-img" src="t" alt="">
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
    </div>
</div>
    @yield('modal')
        <!-- Navigation bar-->
            <div>
        <!-- MENU TAB -->
        <div class="mainmenu-wrapper">
            <div class="container">
                <div class="mainmenu">
                    <ul>
                        <li class='left'><img src="{{Information::where('type' ,'=' , 'logo')->first()['value']}}" width=30 height=30/>{{Information::where('type' ,'=' , 'primary')->first()['value']}} </li>
                    </ul>
                </div>
                <nav id="mainmenu" class="mainmenu">
                    <ul class="menu">
                        <li class=""><a href="{{url('/home')}}"><i class="fa fa-home"></i> Home</a></li>
                        <li class=""><a href="{{url('/equip')}}"><i class="fa fa-spoon"></i> Equipments</a></li>
                        <li class=""><a href="{{url('/menu/home')}}"><i class="fa fa-navicon"></i> Menu</a></li>
                        <li class=""><a href="{{url('/reservation')}}"><i class="fa fa-book"></i> Reservation</a></li>
                        <li class=""><a href="{{url('/contact')}}"><i class="fa fa-phone"></i> Contact Us</a></li>
                        <li><button data-toggle="modal" data-target="#loginModal" href="#" class=""><span class="fa fa-sign-in"></span> Sign in</button></li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
        <!-- / MENU TAB -->
    <div class='row'>
        <div class="col-md-12">
            @yield('content-head')
        </div>
    </div>
 		<!-- Services -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" align='center'>
                        <div class="in-press press-wired">
                            <div>
                                <h3 class="page-header">
                                    Welcome to {{Information::where('type', '=' ,'primary')->first()['value']}}
                                </h3>
                            </div>
                            <div>
                                <p> Already have a Reservation? </p>
                            </div>
                        </div>
                        <a data-toggle="modal" data-target="#checkReservation" href="#" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-edit"></span> Check Reservation</a>
                        @if($errors->has('notice'))
                            <div class="alert alert-info alert-dismissible" role="alert">
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <h4>{{$errors->first('notice')}}</h4>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- End Services -->
        <div class='row'>
            <div class="col-md-12">
                    @yield('body')
            </div>
        </div>
	    <hr>

	    <!-- Footer -->
	    <div class="footer">
	        <div class="container">
	            <div class="row">
	                <!-- Footer Navigator -->
	                <div class="col-footer col-md-4 col-xs-6">
	                    <h3>Navigate</h3>
	                    <ul class="no-list-style footer-navigate-section">
	                        <li class=""><a href="{{url('/home')}}"><i class="fa fa-home"></i> Home</a></li>
                            <li class=""><a href="{{url('/equip')}}"><i class="fa fa-spoon"></i> Equipments</a></li>
                            <li class=""><a href="{{url('/menu/home')}}"><i class="fa fa-navicon"></i> Menu</a></li>
                            <li class=""><a href="{{url('/reservation')}}"><i class="fa fa-book"></i> Reservation</a></li>
                            <li class=""><a href="{{url('/contact')}}"><i class="fa fa-phone"></i> Contact Us</a></li>
	                        <li><a href="#"><i class="fa fa-user"></i> About Us</a></li>
	                    </ul>
	                </div>
	                <!-- footer Contacts -->
	                <div class="col-footer col-md-5 col-xs-6">
	                    <h3>Contacts</h3>
	                        <p class="contact-us-details">
                            <?php
                                $info = Information::where('type' , '=' , 'contact')->get();
                                foreach ($info as $key => $value) {
                                    echo '<b>'.ucfirst($value['keyname']).': </b>';
                                    echo $value['value'].'<br/>';
                                }
                            ?>
	                       </p>
	                </div>
	                <!-- Footer stay connected -->
	                <div class="col-footer col-md-3 col-xs-6">
	                    <h3>Stay Connected</h3>
	                        <ul class="footer-stay-connected no-list-style">
                                <?php
                                $info = Information::where('type' , '=' , 'link')->get();
                                foreach ($info as $key => $value) {
                                    echo '<li> <a href="'.$value['value'].'" class="'.$value['keyname'].'" ></a></li>';
                                }
                            ?>
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
	    <!-- / Footer-->

        <!-- Javascripts -->
        <script src="{{asset('homepage/js/jquery.sequence-min.js')}}"></script>
	    <script src="http://cdn.leafletjs.com/leaflet-0.5.1/leaflet.js"></script>
	    <script src="{{asset('homepage/js/jquery.fitvids.js')}}"></script>
	    <script src="{{asset('homepage/js/jquery.bxslider.js')}}"></script>
	    <script src="{{asset('homepage/js/template.js')}}"></script>
        <script src="{{asset('addasset/js/sweetalert.min.js')}}"></script>
        <script src="{{asset('homepage/js/main-menu.js')}}"></script>
        

        <script src="{{asset('homepage/js/bootstrap.min.js')}}" type="text/javascript"></script>
        
       
        @if($errors)
        <script type="text/javascript">
        $(document).ready(function(){
            var errors = '{{$errors->first()}}';
            if(errors.length > 0)swal("Error",errors ,"error");
        });
        </script>
        @endif

        @if(Session::get('flash_message'))
        <script type="text/javascript">
        var xx= "{{Session::pull('flash_message')}}";
        swal("Success!",xx ,"success");
        </script>
        @endif



    @yield('scripts')
    </body>
</html>