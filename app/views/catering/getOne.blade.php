<html>
<body>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" style = "text-align: center"><b>{{ucwords($menu->name)}}</b></h4>
            </div>
        <div class="modal-body"><div class="te">

        <h4><b>Description:</b> {{$menu->description}}</h4>
         <h4><b>Price:</b> {{$menu->price}}</h4>

        <img src="{{asset('assets/menu/'.$menu->image)}}" class="user-image img-responsive" height = "20" width="550" alt="LALA"/>
        </div></div>

</body>

</html>
