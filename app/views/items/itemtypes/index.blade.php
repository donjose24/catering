@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-clients"></i> Item Categories</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Description</th>
        <th><a href="{{ action('Items\ItemTypesController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($itemtypes as $itemtype)
        <tr>
          <td>{{ $itemtype->id }}</td>
          <td>{{ $itemtype->name }}</td>
          <td>{{ $itemtype->description }}</td>
          <td>
            <a href="{{ action('Items\ItemTypesController@show', ['itemtype' => $itemtype->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
