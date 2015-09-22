
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
                    <div class="col-md-12 col-sm-6">
                        <div class="in-press press-wired">
                           <div class="col-md-12 col-sm-6">
                                @foreach($content as $c)
                                <div class="service-wrapper">
                                    <!-- start content-->
                                    <div>
                                        <p><small class="pull-right badge">{{$c->created_at}}</small></p>
                                        <h3 class="page-header"> {{$c->title}}</h3>
                                        <p>{{$c->content}}</p>
                                    </div>
                                    <!--end content-->
                                </div>
                                @endforeach
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
