
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Purchases\PurchasesController@purchaseOrders')}}"><i class="fa fa-arrow-left"></i> Back to Purchase Orders Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> INVENTORY SYSTEM
    <div class="pull-right"> 
      <small>{{ $purchase->date }}</small>
    </div>
      
    <br><small>Sta. Mesa Manila</small>
  </h1>

  {{ Form::open(['action' => ['Sales\QuotationsController@store'], 'files' => true, 'role' => 'form']) }}

  {{ Form::close() }}

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('si_number', 'Sales Invoice #:') }}
        {{ Form::text('si_number', $purchase->si_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('supplier_id', 'Supplier:') }}
        {{ Form::text('supplier_id', $purchase->supplier->supplier_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('client_company', 'Company') }}
        {{ Form::text('client_company', $purchase->supplier->company_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_tel', 'Telephone') }}
        {{ Form::text('client_tel', $purchase->supplier->tel_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('client_address', 'Address') }}
        {{ Form::text('client_address', $purchase->supplier->street_address, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_fax', 'Fax') }}
        {{ Form::text('client_tel', $purchase->supplier->fax_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#items" data-toggle="tab">Items</a></li>
    <li><a href="#receiving" data-toggle="tab">Receiving</a></li>
    <li><a href="#payments" data-toggle="tab">Payments</a></li>
  </ul>

  <div class="tab-content">
    <!-- ITEMS TAB FOR SO -->
    <div class="tab-pane active" id="items">
      <h2><i class="fa fa-bars"></i> Items</h2>
         <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th>Model#</th>
                <th>Description</th>
                <th>Dimensions</th>
                <th>Qty</th>
                <th>Delivered</th>
                <th>Price</th>
                <th>Line Price</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($purchase->items as $item)
                <tr>
                  <td>{{ $item->model_number }}</td>
                  <td>{{ $item->description }}</td>
                  <td>{{ $item->dimensions }}</td>
                  <td>{{ $item->pivot->quantity }}</td>
                  <td>{{ $item->pivot->delivered_quantity }} </td>
                  <td>{{ $item->pivot->price }}</td>
                  <td>{{ $item->pivot->line_total }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>

  <!-- DELIVERIES TAB FOR SO -->
    <div class="tab-pane" id="receiving">
      <h2><i class="fa fa-bars"></i> Receiving</h2>
     <table class="table table-responsive table-striped">
        <thead>
          <tr>
            <th>Ref#</th>
            <th>Deliver Date</th>
            <th>Delivered By</th>
            <th>
              @if ($purchase->delivery_status !== 'CompletelyDelivered')
                <a href="{{ action('Purchases\ReceivingsController@create', [$purchase->id]) }}"><i class="fa fa-plus"></i> Create Receiving Report</a>
              @endif
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($purchase->receivings as $receiving)
            <tr>
              <td> <a href="{{ action('Purchases\ReceivingsController@show', [$receiving->id]) }}"> {{ $receiving->reference_number }} </a></td>
              <td>{{ $receiving->date }}</td>
              <td>{{ $receiving->received_by }}</td>
              <td> <a href="{{ action('Purchases\ReceivingsController@destroy', [$receiving->id]) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a> </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>


    <div class="tab-pane" id="payments">
      <h2><i class="fa fa-bars"></i> Payments</h2>
     <table class="table table-responsive table-striped">
        <thead>
          <tr>
            <th>Ref#</th>
            <th>Amount</th>
            <th>Deliver Date</th>
            <th>@if ($purchase->billing_status !== 'FullPayment')
                          <a href="{{ action('Purchases\PaymentsController@create', $purchase->id) }}"><i class="fa fa-plus"></i> Add Payment Receipt</a>
                @endif
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($purchase->payments as $payment)
            <tr>
              <td>{{ $payment->payment_receipt }}</td>
              <td>{{ $payment->amount }}</td>
              <td>{{ $payment->date }}</td>
              <td>
                <a href="{{ action('Sales\CollectionsController@destroy', [$payment->id]) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

    </div>
  </div>

<!--  TERMS AND TOTAL -->
    <div class="col-md-12"><hr></div>
    <div class="row">
      <div class="form-horizontal col-md-6">
        <div class="form-group">
          {{ Form::label('terms', 'Terms', ['class' => 'col-md-3 control-label']) }}
          <div class="col-md-3">
            <div class="input-group">
              {{ Form::text('terms', $purchase->terms, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">days</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('discount', 'Discount', ['class' => 'col-md-3 control-label']) }}
          <div class="col-md-3">
            <div class="input-group">
              {{ Form::text('discount', $purchase->discount, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">%</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('tax', 'Tax', ['class' => 'col-md-3 control-label']) }}
          <div class="col-md-3">
            <div class="input-group">
              {{ Form::text('tax', $purchase->tax, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">%</span>
            </div>
          </div>
        </div>      


      </div>
      <?php 
        // $purchase->grand_total = Total of all items. VAT INCLUSIVE
        // $purchase->net_total = Total of all items less discount. VAT INCLUSIVE
        //
        $discountedAmount = $purchase->grand_total - ($purchase->grand_total *((100-$purchase->discount)/100)); 
        $discountedVAT = ($purchase->net_total/((100+$purchase->tax/100))); //extract VAT from Discounted Price
      ?>
       <div class="form-horizontal col-md-6">
   <div class="form-group">
        {{ Form::label('', 'Total Sales', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
          {{ Form::text('', number_format($purchase->grand_total, 2, '.', ','), ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('', 'Less: Discount', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($discountedAmount, 2, '.', ','), ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div>  
      <div class="form-group">
        {{ Form::label('', 'Amount Due (VAT Inclusive)', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($purchase->net_total, 2, '.', ','), ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div> 
      <div class="form-group">
        {{ Form::label('', 'Less: VAT', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($discountedVAT,2, '.', ',') , ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div>    
     <div class="form-group">
        {{ Form::label('', 'Vatable Amount', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($purchase->net_total-$discountedVAT,2, '.', ',') , ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div> 
    <div class="form-group">
        {{ Form::label('', 'Amount Paid', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($purchase->payments->sum('amount'),2, '.', ',') , ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div>
    </div>
  </div>

  <?php if ($purchase->billing_status == 'SalesOrder') { ?>
  <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-1">
    {{--{{ Form::model($purchase, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $purchase->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'Draft')}}
      <button type="submit" class="btn btn-warning">
        <i class="fa fa-save"></i> Return to Draft
      </button>
     {{ Form::close() }}  --}}
  </div>
  <?php } ?>
    {{--this--}}
  <br />
  <br />
  <br />
@stop
