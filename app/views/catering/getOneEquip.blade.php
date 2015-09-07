<html>
<body>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" style = "text-align: center"><b>{{ucwords($package->name)}}</b></h4>
            </div>
        <div class="modal-body"><div class="te">

         <h4><b>Model Number:</b> {{$package->model_number}}</h4>
         <h4><b>Description:</b> {{$package->description}}</h4>
         <h4><b>Dimension:</b> {{$package->dimensions}}</h4>
         <h4><b>Price:</b> {{$package->average_price}}</h4>
        <hr>


                 <center><img src="{{asset('equipments/'.$package->image)}}" class="user-image img-responsive" height = "500" width="500" />
                                         </center> <hr>


        </div></div>

</body>

</html>
