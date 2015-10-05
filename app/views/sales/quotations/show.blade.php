
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\QuotationsController@index')}}"><i class="fa fa-arrow-left"></i> Back to Quotation Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <div class="pull-right"> 
      <div class="row"><small>{{ $quotation->date }}</small></div>
      <div class="row">
        {{ Form::open(['method' => 'delete',  'action' => ['Sales\QuotationsController@destroy', 'quotation' => $quotation->id]]) }}
          <div class="btn-group"> <a href="{{ action('Sales\QuotationsController@edit', ['quotation' => $quotation->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>
  </h1>

  {{ Form::open(['action' => ['Sales\QuotationsController@store'], 'files' => true, 'role' => 'form']) }}

  {{ Form::close() }}

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('quotation_number', 'Reference #:') }}
        {{ Form::text('quotation_number', $quotation->quotation_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
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

<!-- ADDING QUOTATION LINE ITEMS -->
<!-- REMOVE IF STATUS IS PENDING APPROVAL --> 
<?php if ($quotation->billing_status == 'Draft') { ?>
  {{ Form::open(['action' => ['Sales\QuotationsController@attachItem'], 'files' => true, 'role' => 'form']) }}
    {{ Form::hidden('quotation_id', $quotation->id ) }}
    <div class="row">
      <div class="form-group col-md-3">
        {{ Form::label('item_id', 'Item') }}
        {{ Form::select('item_id', ['' => 'Select Item'] + $items, '', ['class' => 'form-control', 'id' => 'item-id', 'required']) }}
      </div>  
      <div class="form-group col-md-2">
        {{ Form::label('item_qty', 'Qty') }}
        {{ Form::text('item_qty', '1', ['class' => 'form-control','required']) }}
      </div>      
      <div class="form-group col-md-3">
        {{ Form::label('item_price', 'Item Price') }}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
          {{ Form::text('item_price','', ['class' => 'form-control', 'item_price','required']) }}
        </div>
      </div>
      <div class="form-group col-md-3">
        {{ Form::label('line_discount', 'Line Discount') }}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
          {{ Form::text('line_discount','0', ['class' => 'form-control']) }}
        </div>
      </div>  
      <div class="form-group col-md-1">
          <button type="submit" class="btn btn-success btn-lg" id="button-add-line-item">Add <i class="fa fa-level-down"></i></button>
        </div>
      </div>
  {{ Form::close() }}
<?php } ?>

 <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Model#</th>
        <th>Description</th>
        <th>Dimensions</th>
        <th>Qty</th>
        <th>Price</th>
        <th>Item Discount</th>
        <th>Line Price</th>
        <?php if ($quotation->billing_status == 'Draft') { ?> 
          <th></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      @foreach ($quotation->items as $item)
        <tr>
          <td>{{ $item->model_number }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->dimensions }}</td>
          <td>{{ $item->pivot->quantity }}</td>
          <td>{{ $item->pivot->price }}</td>
          <td>{{ $item->pivot->line_discount }} ({{ round($item->pivot->line_discount/$item->pivot->price * 100, 2) }} %)</td>
          <td>{{ $item->pivot->line_total }}</td>
          <?php if ($quotation->billing_status == 'Draft') { ?> 
            <td> 
              {{ Form::open(['action' => ['Sales\QuotationsController@detachItem'], 'files' => true, 'role' => 'form']) }}
                  {{ Form::hidden('item_id', $item->id) }}
                  {{ Form::hidden('line_total', $item->pivot->line_total) }}
                  {{ Form::hidden('quotation_id', $quotation->id) }}  
                    <button type="submit" class="btn btn-danger pull-right">
                      <i class="fa fa-trash-o"></i>
                    </button>
              {{ Form::close() }}
            </td>
          <?php } ?>
        </tr>
      @endforeach
    </tbody>
  </table>

<?php 
  // $quotation->grand_total = Total of all items. VAT INCLUSIVE
  // $quotation->net_total = Total of all items less discount. VAT INCLUSIVE
  //
  $totalLessVAT = round(($quotation->grand_total*$quotation->tax/(100+$quotation->tax)), 2);
  $discountedAmount = $quotation->grand_total - ($quotation->grand_total *((100-$quotation->discount)/100)); 
  $discountedVAT = round(($quotation->net_total*$quotation->tax/(100+$quotation->tax)), 2); //extract VAT from Discounted Price
?>
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

        <br />
        <br />
        <br />
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
             
    </div>
  </div>
  <?php if ($quotation->billing_status == 'Draft') { ?>
     {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'PendingApproval')}}
      <button type="submit" class="btn btn-success pull-right">
        <i class="fa fa-save"></i> Send For Approval
      </button>
     {{ Form::close() }}
  <?php } ?>

  <?php if ($quotation->billing_status == 'PendingApproval' || $quotation->billing_status == 'SalesOrder') { ?>
  <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-1">
    {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'Draft')}}
      <button type="submit" class="btn btn-warning">
        <i class="fa fa-save"></i> Return
      </button>
     {{ Form::close() }}  
  </div>
  <div class="col-md-1">
     {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'Approved')}}
      <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i> Approve
      </button>
     {{ Form::close() }}  
  </div>
</div>
  <?php } ?>

  <?php if ($quotation->billing_status == 'Approved') { ?>
      {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@createSO', $quotation->id], 'role' => 'form']) }}
        {{ Form::hidden('billing_status' ,'SalesOrder')}}
        <div class="row">
          <div class="col-md-6">
          {{ Form::label('so_number', 'SO#', ['class' => 'control-label']) }}
		  {{ Form::text('so_number', str_pad($quotation->id,5,'0', STR_PAD_LEFT ) , ['class' => 'form-control', 'readonly' => 'true'])  }}
          </div>
        </div>
      {{ Form::close() }}
  <?php } ?>

<br />
<br />
<br />

<script>
    $('#item-id')
    .change(function() {
      $.post(
        "{{ url ('items/items/getOne') }}",
        { option: $(this).val() },
        function (data) {
          console.dir(data);
          console.dir(data.company_name);
          $('#item_price').val(data.average_price);

        });
    }); 

    $('#button-add-line-item')
      .click(function() {
        //$(this).parents("form").children("div").children("div").children("input").prop("disabled",true);
        //$(this).parents("form").children("div").children("div").children("select").prop("disabled",true);
    });
</script>

@stop
