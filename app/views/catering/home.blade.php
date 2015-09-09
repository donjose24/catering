@extends('layouts.home')

@section('content-head')
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
    <?php $index = 0 ?>
         @foreach($carousel as $carousels)
             @if($index == 0)
                  <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
              @else
                  <li data-target="#carousel-example-generic" data-slide-to="<?php echo $index ?>"></li>
             @endif
            <?php $index++ ?>
         @endforeach

   </ol>
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
@stop
@section('body')
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
                                {{Form::open(['url' => 'catering/reservation/check/reservation'])}}
                                 {{Form::label('id','Reservation ID:')}}
                                 {{Form::text('id','',['class' => 'form-control','required'])}}

                            </div>
                            <div>
                                <input class="btn btn-block" type="submit" value="Submit">
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
    @section('scripts')
    <script>
    $('.carousel').carousel({
        interval: 5000 //changes the speed
    })
    </script>
    @stop
</html>
