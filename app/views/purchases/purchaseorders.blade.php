@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Purchase Orders</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>SI#</th>
        <th>Purchase#</th>
        <th>Date</th>
        <th>Supplier</th>
        <th>Total</th>
        <th>Billing Status</th>
        <th>Delivery Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($purchases as $purchase)
        <tr>
          <td>{{ $purchase->si_number }}</td>
          <td>{{ $purchase->po_number }}</td>
          <td>{{ $purchase->date }}</td>
          <td>{{ $purchase->supplier->supplier_name }}</td>
          <td>{{ $purchase->net_total }}</td>
          <td>{{ $purchase->billing_status }}</td>
          <td>{{ $purchase->delivery_status }}</td>
          <td> 
            <a href="{{ action('Purchases\PurchasesController@purchaseOrderShow', $purchase->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
