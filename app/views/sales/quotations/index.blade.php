@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Quotations</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Ref #</th>
        <th>Date</th>
        <th>Client</th>
        <th>Address</th>
        <th>Total</th>
        <th>Status</th>
        <th>
          <a href="{{ action('Sales\QuotationsController@create') }}"><i class="fa fa-plus"></i> Create</a>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($quotations as $quotation)
        <tr>
          <td>{{ $quotation->quotation_number }}</td>
          <td>{{ $quotation->date }}</td>
          <td>{{ $quotation->client->customer_name }}</td>
          <td>{{ $quotation->client->street_address }} {{ $quotation->client->city }} </td>
          <td class="text-right">{{ number_format($quotation->net_total, 2, '.', ',') }}</td>
          <td>{{ $quotation->billing_status }}</td>
          <td> 
            <a href="{{ action('Sales\QuotationsController@show', $quotation->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <?php echo $quotations->links(); ?>
@stop
