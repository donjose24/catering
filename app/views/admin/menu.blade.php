@extends('layouts.admin')

@section('title')
    <b>List of Menu</b>
    <script>
    $('body').on('hidden.bs.modal', '.modal', function () {
      $(this).removeData('bs.modal');
    });
    </script>
@stop

@section('body')
<div class="modal fade" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                         <h4 class="modal-title" style = "text-align: center"><b>Add Menu</b></h4>
                    </div>
                <div class="modal-body"><div class="te">
                {{Form::open(['action' => 'AdminController@addMenu','files'=>true])}}
                <h4><b>Name:</b> </h4> {{Form::text('name','',['class' => 'form-control'])}}
                <h4><b>Description:</b></h4> {{Form::textarea('description','',['class' => 'form-control','style' => 'resize: none;'])}}
				<h4><b>Price:</b> </h4>{{Form::number('price','',['class' => 'form-control', 'min' => '0', 'step' => 'any'])}}
                <h4><b>Category:</b> </h4>
                <select name="scat" class="form-control" id="selected-prize" required>
                    @foreach ($category as $categories)
                       <option value="{{$categories->name}}">{{$categories->name}}</option>
                    @endforeach
                </select>
                <h4><b>Served for:</b> </h4>
                <select name="mcat" class="form-control" id="selected-prize" required>
                       <option value="breakfast">Breakfast</option>
                       <option value="lunch_and_dinner">Lunch and Dinner</option>
                       <option value="lunch_only">Lunch Only</option>
                       <option value="dinner_only">Dinner Only</option>
                       <option value="appetizer">Appetizer</option>
                       <option value="merienda">Merienda</option>
                       <option value="drinks">Drinks</option>
                </select>
                <h4><b>Upload Image:</b> </h4>{{ Form::file('image', ['required']) }}
                </div>
            </div>
            <div class="modal-footer">
                <input value="Submit" type="submit" class="btn btn-info btn-lg">
            </div>
            {{Form::close()}}
        </div>
    </div>
</div>
    <a class='btn btn-info pull-right'data-toggle="modal" data-target="#addMenu"><span class="glyphicon glyphicon-plus"></span> Add Menu</a><br>

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Category</th>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>
			<th>Image</th>
			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($menu as $menus)
		<tr>
			<td><b>{{$menus->id}}</b></td>
			<td>{{$menus->scat}}</td>
			<td>{{$menus->name}}</td>
			<td>{{$menus->description}}</td>
			<td>{{$menus->price}}</td>
            <td>
            @if($menus->image !== '')
            {{ Form::open(['action' => ['AdminController@deletePicture', $menus->id], 'class' => 'form-inline', 'files' => true, 'method' => 'delete']) }}

               <img src="{{ asset('assets/menu/'.$menus->image)}}" width="70" height="70"  >
               <button type="submit" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-remove"></span> </button>
            {{Form::close()}}
            @else
            {{ Form::open(['action' => ['AdminController@updatePicture',$menus->id], 'class' => 'form-inline', 'files' => true, 'method' => 'put']) }}
               {{ Form::file('image', ['required']) }} <br>
                <input value="Upload" type="submit" class="btn btn-info btn-xs">
            {{Form::close()}}
            @endif
            </td>
			<td>
			    <a href="{{action('AdminController@getDetails', $menus->id)}}" class="btn btn-warning btn-sm" ><span class="glyphicon glyphicon-folder-open"></span> Update</a><br>
			    <a href="{{action('AdminController@deleteMenu',$menus->id)}}" class="btn btn-danger btn-sm"><span class="glyphicon glyphicon-remove-sign"></span> Delete&nbsp;&nbsp;</a>
			</td>
			</tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$menu->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop
