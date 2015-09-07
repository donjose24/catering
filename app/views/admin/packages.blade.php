@extends('layouts.admin')

@section('title')
    <b>Packages</b>
    <button type="button" data-toggle='modal' data-target="#packagesModal" class="btn btn-info pull-right"><span class="glyphicon glyphicon-plus"></span> Add Package</button>
@stop

@section('modal')
    <div class="modal fade" id="packagesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                             <h4 class="modal-title" style = "text-align: center"><b>ADD PACKAGE</b></h4>
                        </div>
                     {{Form::open(['action' => 'AdminController@addPackage'])}}
                    <div class="modal-body">
                        <div class="te">
                             <h4><b>Package Name:</b> {{Form::text('name','',['class' => 'form-control','required'])}}</h4>
                             <h4><b>Price:</b> {{Form::number('price','',['class' => 'form-control','required'])}}</h4>
                             <h4><b>Description:</b> {{Form::textarea('description','',['class' => 'form-control','required','style' => 'resize:none'])}}</h4>
                             <hr>
                             <h4><b>Include Menu:</b></h4>

                             @foreach($categories as $category)
                             <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{{ucwords($category->name)}}</h3>
                                </div>
                                <div class="panel-body">
                                <fieldset class="group">
                                @foreach(Menu::where('scat','=',$category->name)->get() as $menu)
                                    <ul class="checkbox">
                                        <li>
                                            <input name="menu[]" style="width: 16px;" type="checkbox" value="{{$menu->id}}"> {{$menu->name}}
                                        </li>
                                    </ul>
                                @endforeach
                                </fieldset>
                                </div>
                              </div>
                             @endforeach
                        </div>
                    </div>
                    <div class="modal-footer">
                       <button type="submit " class="btn btn-primary">Save</button>
                    </div>
                    {{Form::close()}}
            </div>
        </div>
    </div>
@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Description</th>
			<th>Price</th>

			<th>Action</th>
		</tr>
		</thead>
		<tbody>
		@foreach($package as $packages)
		<tr>
			<td><b>{{$packages->id}}</b></td>
			<td>{{$packages->name}}</td>
			<td>{{$packages->description}}</td>
			<td> &#8369; {{$packages->price}}</td>
			<td><a href="{{action('AdminController@showPackage',$packages->id)}}" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-folder-open"></span> Details</a></td>
			</tr>
		@endforeach
		</tbody>
		<tfoot>
		<tr>
		    <td colspan="7" style="text-align:right">
                <nav>
                  <ul class="pagination">
                    {{$package->links();}}
                    <li></li>
                  </ul>
                </nav>
		    </td>
		</tr>

		</tfoot>

		</table>
@stop