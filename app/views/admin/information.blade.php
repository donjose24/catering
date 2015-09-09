@extends('layouts.admin')

@section('title')
    <b>Company Information</b>
@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Key</th>
			<th>Value</th>
			<th>Type</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($informations as $info)
		<tr>
			<td><b>{{$info->id}}</b></td>
			<td><b>{{$info->keyname}}</b></td>
			<td><b>{{$info->value}}</b></td>
			<td><b>{{$info->type}}</b></td>
			<td class="edit"><button  data-id="{{$info->id}}" data-value="{{$info->value}}" data-route="{{url('/misc/set-information/')}}" data-keyname="{{$info->keyname}}"  class='btn-edit btn btn-block btn-primary'><i class="fa fa-edit"></i>Edit value</button></td>
			
        </tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                  
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.edit').delegate('.btn-edit' ,'click', function(){
				var url = $(this).data('route') + "/" + $(this).data('id') +"/";
				swal({   
				   title: "Enter new value for " + $(this).data('keyname'),   
				   text: "Information ID: " + $(this).data('id'),
				   type: "input",   
				   showCancelButton: true,   
				   closeOnConfirm: false,  
				   animation: "slide-from-top",  
				   inputPlaceholder: "Write something" }, 
				   function(inputValue){   
				   	if (inputValue === false) return false;      
				   	if (inputValue === "") {     
				   		swal.showInputError("You need to write something!");     return false   
				   	} 
				   inputValue=	inputValue.replace(/\//gi, "-");
				   	window.location.assign(url + inputValue);

				   	swal("Nice!", "You wrote: " + inputValue, "success"); 
				   });
			});
		});
	</script>
@stop