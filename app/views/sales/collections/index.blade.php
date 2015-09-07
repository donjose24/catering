@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Collections</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Ref #</th>
        <th>SO #</th>
        <th>Client</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($collections as $collection)
        <tr>
          <td>{{ $collection->date }}</td>
          <td>{{ $collection->cr_id }}</td>
          <td><a href="{{ action('Sales\QuotationsController@salesordershow', $collection->quotation->id) }}">{{ $collection->quotation->so_number }}</a></td>
          <td>{{ $collection->quotation->client->customer_name }}</td>
          <td>{{ number_format($collection->amount, 2, '.', ',') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
