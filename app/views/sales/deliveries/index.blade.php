@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-truck"></i> Deliveries</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Ref #</th>
        <th>SO #</th>
        <th>Date</th>
        <th>Client</th>
        <th>Status</th>
        <th>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($deliveries as $delivery)
        <tr>
          <td>{{ $delivery->reference_number }}</td>
          <td><a href="{{ action('Sales\QuotationsController@salesordershow', $delivery->quotation->id) }}">{{ $delivery->quotation->so_number }} </a> </td>
          <td>{{ $delivery->delivery_date }}</td>
          <td>{{ $delivery->quotation->client->customer_name }}</td>
          <td>{{ $delivery->quotation->delivery_status }}</td>
          <td> 
            <a href="{{ action('Sales\DeliveriesController@show', $delivery->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
