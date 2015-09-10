
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\QuotationsController@index')}}"><i class="fa fa-arrow-left"></i> Back to Quotation Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <div class="pull-right"> 
      <small>{{ $quotation->date }}</small>
    </div>
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>
  </h1>

  {{ Form::open(['action' => ['Sales\QuotationsController@store'], 'files' => true, 'role' => 'form']) }}

  {{ Form::close() }}

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('so_number', 'Sales Order #:') }}
        {{ Form::text('so_number', $quotation->so_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('agent_id', 'Sales Agent:') }}
        {{ Form::text('agent_id', $quotation->agent->first_name.' '.$quotation->agent->last_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>  
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('client_id', 'To:') }}
        {{ Form::text('client_id', $quotation->client->customer_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('client_company', 'Company') }}
        {{ Form::text('client_company', $quotation->client->company_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_tel', 'Telephone') }}
        {{ Form::text('client_tel', $quotation->client->tel_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('client_address', 'Address') }}
        {{ Form::text('client_address', $quotation->client->street_address, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_fax', 'Fax') }}
        {{ Form::text('client_tel', $quotation->client->fax_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>
  <ul class="nav nav-tabs">
    <li class="active"><a href="#items" data-toggle="tab">Items</a></li>
    <li><a href="#deliveries" data-toggle="tab">Deliveries</a></li>
    <li><a href="#collections" data-toggle="tab">Collections</a></li>
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
              @foreach ($quotation->items as $item)
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
    <div class="tab-pane" id="deliveries">
      <h2><i class="fa fa-bars"></i> Deliveries</h2>
     <table class="table table-responsive table-striped">
        <thead>
          <tr>
            <th>Ref#</th>
            <th>Deliver Date</th>
            <th>Delivered By</th>
            <th>
              @if ($quotation->delivery_status !== 'CompletelyDelivered')
                <a href="{{ action('Sales\DeliveriesController@create', [$quotation->id]) }}"><i class="fa fa-plus"></i> Create Delivery Receipt</a>
              @endif
            </th>
          </tr>
        </thead>
        <tbody>
          @foreach ($quotation->deliveries as $delivery)
            <tr>
              <td> <a href="{{ action('Sales\DeliveriesController@show', [$delivery->id]) }}"> {{ $delivery->reference_number }} </a></td>
              <td>{{ $delivery->delivery_date }}</td>
              <td>{{ $delivery->delivered_by }}</td>
              <td> <a href="{{ action('Sales\DeliveriesController@destroy', [$delivery->id]) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a> </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>

  <!-- COLLECTIONS TAB FOR SO -->
    <div class="tab-pane" id="collections">
      <h2><i class="fa fa-bars"></i> Collections</h2>
     <table class="table table-responsive table-striped">
        <thead>
          <tr>
            <th>Ref#</th>
            <th>Amount</th>
            <th>Deliver Date</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($quotation->collections as $collection)
            <tr>
              <td>{{ $collection->cr_id }}</td>
              <td>{{ $collection->amount }}</td>
              <td>{{ $collection->date }}</td>
              <td>
                <a href="{{ action('Sales\CollectionsController@destroy', [$collection->id]) }}" class="btn btn-danger"><i class="fa fa-trash-o"></i> </a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
        @if ($quotation->billing_status !== 'FullPayment')
          <a href="{{ action('Sales\CollectionsController@create', $quotation->id) }}"><i class="fa fa-plus"></i> Add Collection Receipt</a>
        @endif
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
              {{ Form::text('terms', $quotation->terms, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">days</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('discount', 'Discount', ['class' => 'col-md-3 control-label']) }}
          <div class="col-md-3">
            <div class="input-group">
              {{ Form::text('discount', $quotation->discount, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">%</span>
            </div>
          </div>
        </div>
        <div class="form-group">
          {{ Form::label('tax', 'Tax', ['class' => 'col-md-3 control-label']) }}
          <div class="col-md-3">
            <div class="input-group">
              {{ Form::text('tax', $quotation->tax, ['class' => 'form-control', 'disabled' => 'disabled']) }}
              <span class="input-group-addon">%</span>
            </div>
          </div>
        </div>      


      </div>
      <?php 
        // $quotation->grand_total = Total of all items. VAT INCLUSIVE
        // $quotation->net_total = Total of all items less discount. VAT INCLUSIVE
        //
        $discountedAmount = $quotation->grand_total - ($quotation->grand_total *((100-$quotation->discount)/100)); 
        $discountedVAT = ($quotation->net_total/((100+$quotation->tax/100))); //extract VAT from Discounted Price
      ?>
       <div class="form-horizontal col-md-6">
   <div class="form-group">
        {{ Form::label('', 'Total Sales', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
          {{ Form::text('', number_format($quotation->grand_total, 2, '.', ','), ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
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
            {{ Form::text('', number_format($quotation->net_total, 2, '.', ','), ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
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
            {{ Form::text('', number_format($quotation->net_total-$discountedVAT,2, '.', ',') , ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div> 
      <div class="form-group">
        {{ Form::label('', 'Amount Paid', ['class' => 'col-md-5 control-label']) }}
        <div class="col-md-3">
            {{ Form::text('', number_format($quotation->collections->sum('amount'),2, '.', ',') , ['class' => 'form-control text-right', 'disabled' => 'disabled']) }}
        </div>
      </div>              
    </div>
  </div>

  <?php if ($quotation->billing_status == 'SalesOrder') { ?>
  <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-1">
    {{--{{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'SO')}}
      <button type="submit" class="btn btn-warning">
        <i class="fa fa-save"></i> Return to Draft
      </button>
     {{ Form::close() }}--}}
  </div>
  <?php } ?>
  <?php if ($quotation->billing_status == 'FullPayment') { ?>
      {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}
        {{ Form::hidden('billing_status' ,'FullPayment')}}
        <div class="row">
          <div class="col-md-6">
          {{ Form::label('si_number', 'SI#', ['class' => 'control-label']) }}
          {{ Form::text('si_number', null, ['class' => 'form-control'])  }}
          </div>
          <div class="col-md-6">
            <br />
            <button type="submit" class="btn btn-success">
              <i class="fa fa-save"></i> Create SI
            </button>
          </div>
        </div>
      {{ Form::close() }}
  <?php } ?>
  <br />
  <br />
  <br />
@stop
