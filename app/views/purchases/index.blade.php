@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Purchase Orders</h1>
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
          <a href="{{ action('Purchases\PurchasesController@create') }}"><i class="fa fa-plus"></i> Create</a>
        </th>
      </tr>
    </thead>
    <tbody>
      @foreach ($purchases as $purchase)
        <tr>
          <td>{{ $purchase->po_number }}</td>
          <td>{{ $purchase->date }}</td>
          <td>{{ $purchase->supplier->supplier_name }}</td>
          <td>{{ $purchase->supplier->street_address }} {{ $purchase->supplier->city }} </td>
          <td class="text-right">{{ number_format($purchase->net_total, 2, '.', ',') }}</td>
          <td>{{ $purchase->billing_status }}</td>
          <td> 
            <a href="{{ action('Purchases\PurchasesController@show', $purchase->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
  <?php echo $purchases->links(); ?>
@stop
