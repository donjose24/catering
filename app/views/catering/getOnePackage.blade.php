<html>
<body>
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                 <h4 class="modal-title" style = "text-align: center"><b>{{ucwords($package->name)}}</b></h4>
            </div>
        <div class="modal-body"><div class="te">

        <h4><b>Description:</b> {{$package->description}}</h4>
         <h4><b>Price:</b> {{$package->price}}</h4>
        <hr>
        @foreach(DB::table('menu_package')->where('package_id', '=', $package->id)->get() as $menu)

            @foreach(Menu::where('id','=',$menu->menu_id)->get() as $menus)
                <h4 class="modal-title pull-left" style = "text-align: center"><b>Dish:</b>{{ucwords($menus->name)}}</h4><br>
                <h4><b>Description:</b> {{$menus->description}}</h4>
                 <img src="{{asset('assets/menu/'.$menus->image)}}" class="user-image img-responsive" height = "20" width="100" />
                 <hr>
            @endforeach
        @endforeach

        </div></div>

</body>

</html>
