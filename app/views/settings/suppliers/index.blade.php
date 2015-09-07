@extends ('layouts.admin')
@section('title')
   <h1><i class="fa fa-clients"></i><b>Suppliers</b> </h1>
@stop
@section ('body')

  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Supplier Name</th>
        <th>Company</th>
        <th><a href="{{ action('Settings\SuppliersController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($suppliers as $supplier)
        <tr>
          <td>{{ $supplier->id }}</td>
          <td>{{ $supplier->supplier_name }}</td>
          <td>{{ $supplier->company_name }}</td>
          <td>
            <a href="{{ action('Settings\SuppliersController@show', ['supplier' => $supplier->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
