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
    @foreach($category as $temp)
         <li role="presentation"><a href="#{{$temp->id}}" aria-controls="{{$temp->id}}" role="tab" data-toggle="tab">{{ucwords($temp->name)}}</a></li>
    @endforeach

  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    @foreach($category as $temp)
        <div role="tabpanel" class="tab-pane fade " id="{{$temp->id}}">
                <div role="tabpanel" class="tab-pane active" id="package">
                    <div class="panel panel-info">
                      <div class="panel-body">
                      <ul class="checkbox">
                         @foreach($temp->items as $package)
                             <li><a data-toggle="modal" href="http://localhost:8000/equip/getOne/{{$package->id}}" data-target="#menuModal">{{$package->model_number}}</a>
                                              </li>
                         @endforeach
                       </ul>
                      </div>
                    </div>
                </div>

        </div>
    @endforeach

  </div>

</div>
@stop