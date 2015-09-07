@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Quotations</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>SO#</th>
        <th>Quote#</th>
        <th>Date</th>
        <th>Client</th>
        <th>Total</th>
        <th>Billing Status</th>
        <th>Delivery Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($quotations as $quotation)
        <tr>
          <td>{{ $quotation->so_number }}</td>
          <td>{{ $quotation->quotation_number }}</td>
          <td>{{ $quotation->date }}</td>
          <td>{{ $quotation->client->customer_name }}</td>
          <td>{{ $quotation->net_total }}</td>
          <td>{{ $quotation->billing_status }}</td>
          <td>{{ $quotation->delivery_status }}</td>
          <td> 
            <a href="{{ action('Sales\QuotationsController@salesordershow', $quotation->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
