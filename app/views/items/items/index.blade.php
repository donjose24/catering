@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-clients"></i> Items</h1>
  @include('errors')
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Model Number</th>
        <th>Description</th>
        <th>Dimensions</th>
        <th>Average Price</th>
        <th>Quantity</th>
        <th>Allocated</th>
        <th>Type</th>
        <th><a href="{{ action('Items\ItemsController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($items as $item)
        <tr>
          <td>{{ $item->id }}</td>
          <td>{{ $item->model_number }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->dimensions }}</td>
          <td>{{ 'Php ' }}{{ $item->average_price }}</td>
          <td>{{ $item->total_quantity}} {{ $item->uom }}</td>
          <td>{{ $item->allocated_quantity}} {{ $item->uom }}</td>
          <td>{{ $item->itemtype->name }}</td>
          <td>
            <a href="{{ action('Items\ItemsController@show', ['item' => $item->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
