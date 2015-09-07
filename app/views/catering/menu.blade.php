@extends('layouts.home')

@section('body')
<script>
$('body').on('hidden.bs.modal', '.modal', function () {
  $(this).removeData('bs.modal');
});
</script>
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#package" aria-controls="package" role="tab" data-toggle="tab">Packages</a></li>
    @foreach($category as $categories)
         <li role="presentation"><a href="#{{$categories->name}}" aria-controls="{{$categories->name}}" role="tab" data-toggle="tab">{{ucwords($categories->name)}}</a></li>
    @endforeach

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="package">
        <div class="panel panel-info">
          <div class="panel-body">
          <ul class="checkbox">
             @foreach($packages as $package)
                 <li><a data-toggle="modal" href="http://localhost:8000/package/getOne/{{$package->id}}" data-target="#menuModal">{{$package->name}}</a>
                                  </li>
             @endforeach
           </ul>
          </div>
        </div>
    </div>

    @foreach($category as $categories)
        <div role="tabpanel" class="tab-pane" id="{{$categories->name}}">
            <div class="panel panel-info">
                      <div class="panel-body">
                        <ul class="checkbox">
                         @foreach(Menu::where('scat','=',$categories->name)->get() as $menu)
                            <li><a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$menu->id}}" data-target="#menuModal">{{$menu->name}}</a></li>
                         @endforeach
                         </ul>
                      </div>
             </div>

        </div>
    @endforeach


  </div>

</div>
@stop