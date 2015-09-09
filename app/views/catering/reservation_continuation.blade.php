@extends('layouts.home')

@section('body')
<script>
$('body').on('hidden.bs.modal', '.modal', function () {
  $(this).removeData('bs.modal');
});
</script>

<<<<<<< HEAD
{{ Form::open(['action' => ['catering\ReservationsController@attachMenu'], 'role' => 'form' , 'id' => 'form']) }}
{{ Form::hidden('id', $id)  }}
<div class='col-md-8 col-md-offset-2'>
=======
{{ Form::open(['action' => ['catering\ReservationsController@attachMenu'], 'role' => 'form']) }}
{{ Form::hidden('id', $id)  }}
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
<div class="panel panel-default">
                 <div class="panel-heading">
                    Equipment
                 </div>

                 <div class="panel-body">
                <table class="table table-striped">
                @foreach($item as $items)
                    <tr>
                        <input type="hidden" name="invId[]" value="{{$items->id}}">
                        <input type="hidden" name="pricey[]" value="{{$items->average_price}}">
                        <td><input type="hidden" name="model[]" value = "{{$items->model_number}}" class="form-control" disabled>
                            <a data-toggle="modal" href="http://localhost:8000/equip/getOne/{{$items->id}}" data-target="#menuModal">{{$items->model_number}}</a>
<<<<<<< HEAD
=======

>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
                        </td>
                        <td>{{Form::number('quantity[]',0,['class' => 'form-control', 'placeholder' => 'Qty'])}}</td>
                    </tr>

                @endforeach
                </table>
            </div>
            </div>

<hr>
<div role="tabpanel">
    <ul class="nav nav-tabs" role="tablist" id="myTab">
       @for($x=1; $x<=$diff; $x++)
            <li role="presentation"><a href="#day{{$x}}" aria-controls="day{{$x}}" role="tab" data-toggle="tab">Day {{$x}}</a></li>
       @endfor
    </ul>

    <div class="tab-content">
    @for($x=1; $x<=$diff; $x++)
      <div role="tabpanel" class="tab-pane fade in @if($x==1)active @endif" id="day{{$x}}">
        <h1>Day {{$x}}</h1>
                <div class="panel panel-default">
                 <div class="panel-heading">
                 	<h3 class="panel-title">Packages</h3>
                 </div>
                 <div class="panel-body">
                 	<fieldset>
                 		<legend>Choose Package</legend>
                 		<ul class="checkbox-grid">
                 			 @foreach($packages as $package)
                 			<li>
                 			<input name="package{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$package->id}}"> <a data-toggle="modal" href="http://localhost:8000/package/getOne/{{$package->id}}" data-target="#menuModal">{{$package->name}}</a>
                 			</li>
                 			 @endforeach
                 		</ul>
                 	</fieldset>
                 </div>
                 </div>

        <div class="panel panel-default">
         <div class="panel-heading">
         	<h3 class="panel-title">Breakfast</h3>
         </div>
         <div class="panel-body">
         	<fieldset>
         		<legend>Pasta</legend>
         		<ul class="checkbox-grid">
         			 @foreach($pasta as $pastas)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$pastas->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$pastas->id}}" data-target="#menuModal">{{$pastas->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         	<hr>
         	<fieldset>
         		<legend>Bread</legend>
         		<ul class="checkbox-grid">
         			 @foreach($bread as $breads)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$breads->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$breads->id}}" data-target="#menuModal">{{$breads->name}}</a>

         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         </div>
         </div>

        <div class="panel panel-default">
         <div class="panel-heading">
         	<h3 class="panel-title">Lunch</h3>
         </div>
         <div class="panel-body">
         	<fieldset>
         		<legend>Chicken</legend>
         		<ul class="checkbox-grid">
         			 @foreach($chicken as $chickens)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$chickens->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$chickens->id}}" data-target="#menuModal">{{$chickens->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         	<hr>
         	<fieldset>
         		<legend>Beef</legend>
         		<ul class="checkbox-grid">
         			 @foreach($beef as $beefs)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$beefs->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$beefs->id}}" data-target="#menuModal">{{$beefs->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         	<hr>
         	<fieldset>
         		<legend>Fish</legend>
         		<ul class="checkbox-grid">
         			 @foreach($fish as $fishes)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$fishes->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$fishes->id}}" data-target="#menuModal">{{$fishes->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
            <hr>
         	<fieldset>
         		<legend>Pork</legend>
         		<ul class="checkbox-grid">
         			 @foreach($pork as $porks)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$porks->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$porks->id}}" data-target="#menuModal">{{$porks->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>

         </div>
         </div> {{--Panel Lunch--}}
        <div class="panel panel-default">
         <div class="panel-heading">
         	<h3 class="panel-title">Appetizers</h3>
         </div>
         <div class="panel-body">
         	<fieldset>
         		<legend>Salad</legend>
         		<ul class="checkbox-grid">
         			 @foreach($salad as $salads)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$salads->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$salads->id}}" data-target="#menuModal">{{$salads->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         	<hr>
         	<fieldset>
         		<legend>Soup</legend>
         		<ul class="checkbox-grid">
         			 @foreach($soup as $soups)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$soups->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$soups->id}}" data-target="#menuModal">{{$soups->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>
         </div>
         </div>{{--panel appetizer--}}
        <div class="panel panel-default">
         <div class="panel-heading">
         	<h3 class="panel-title">Desserts</h3>
         </div>
         <div class="panel-body">
         	<fieldset>
         		<legend>Desserts</legend>
         		<ul class="checkbox-grid">
         			 @foreach($dessert as $desserts)
         			<li>
         			<input name="menu{{$x}}[]" style="width: 16px;" type="checkbox" value="{{$desserts->id}}"> <a data-toggle="modal" href="http://localhost:8000/menu/getOne/{{$desserts->id}}" data-target="#menuModal">{{$desserts->name}}</a>
         			</li>
         			 @endforeach
         		</ul>
         	</fieldset>

         </div>
         </div>{{--panel dessert--}}
                </div>
            @endfor
<<<<<<< HEAD
            <button type="submit" class="btn btn-danger pull-right" id="btn_confirm"> Proceed to Checkout &gt; &gt; </button>
      </div>

    </div>
</div>

{{Form::close()}}

@stop

@section('scripts')
<SCRIPT TYPE="text/javascript">
    
    $(document).ready(function(){
        $('#btn_confirm').click(function(e){
            e.preventDefault();
            swal({   title: "Halt!?",  
             text: "Are you sure you want to proceed to checkout?",  
              type: "warning",  
               showCancelButton: true,  
                confirmButtonColor: "#DD6B55", 
                  confirmButtonText: "Proceed",   
                  cancelButtonText: "No", 
                    closeOnConfirm: false,   closeOnCancel: false }, 
                    function(isConfirm){  
                    if (isConfirm) {    
                        $('#form').submit();
                    } 
                    else {
                         swal("Cancelled", "Roger that! Take your time and pick from our finest selection.", "error");   
                    } });
        });
    });
</SCRIPT>
=======
            <button type="submit" class="btn btn-danger pull-right"> Proceed to Checkout &gt; &gt; </button>
      </div>

    </div>

{{Form::close()}}

>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5
@stop