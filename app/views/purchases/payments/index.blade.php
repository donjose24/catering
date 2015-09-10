@extends ('layouts.admin')

@section ('body')
  <h1 class="page-header"><i class="fa fa-calendar"></i> Accounts Payable</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Date</th>
        <th>Ref #</th>
        <th>SI #</th>
        <th>Client</th>
        <th>Amount</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($payments as $payment)
        <tr>
          <td>{{ $payment->date }}</td>
          <td>{{ $payment->payment_receipt }}</td>
          <td><a href="{{ action('Purchases\PurchasesController@purchaseOrderShow', $payment->purchase->id) }}">{{ $payment->purchase->si_number }}</a></td>
          <td>{{ $payment->purchase->supplier->supplier_name }}</td>
          <td>{{ number_format($payment->amount, 2, '.', ',') }}</td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
