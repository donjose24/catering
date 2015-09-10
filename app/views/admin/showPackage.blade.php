@extends('layouts.admin')

@section('title')
    <b>{{$package->name}}</b>
@stop

@section('body')

<table class="table table-stripe">
		<thead>
		<tr>
			<th>ID</th>
			<th>Name</th>
			<th>Type</th>

		</tr>
		</thead>
		<tbody>
		@foreach(DB::table('menu_package')->where('package_id', '=', $package->id)->get() as $menu)
			@foreach(Menu::where('id','=',$menu->menu_id)->get() as $menus)
			<tr>
				<td><b>{{$menus->id}}</b></td>
				<td>{{ucwords($menus->name)}}</td>
				<td>{{$menus->description}}</td>
				
				</tr>
			@endforeach
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