@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-truck"></i> Receivings</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Ref #</th>
        <th>SI #</th>
        <th>Date</th>
        <th>Client</th>
        <th>Status</th>
        <th>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($receivings as $receiving)
        <tr>
          <td>{{ $receiving->reference_number }}</td>
          <td><a href="{{ action('Purchases\PurchasesController@purchaseOrderShow', $receiving->purchase->id) }}">{{ $receiving->purchase->si_number }} </a> </td>
          <td>{{ $receiving->date }}</td>
          <td>{{ $receiving->purchase->supplier->supplier_name }}</td>
          <td>{{ $receiving->purchase->delivery_status }}</td>
          <td> 
            <a href="{{ action('Purchases\PurchasesController@show', $receiving->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
