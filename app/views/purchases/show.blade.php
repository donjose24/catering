@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Purchases\PurchasesController@index')}}"><i class="fa fa-arrow-left"></i> Back to Purchases Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> INVENTORY SYSTEM
    <div class="pull-right"> 
      <div class="row"><small>{{ $purchase->date }}</small></div>
      <div class="row">
        {{ Form::open(['method' => 'delete',  'action' => ['Purchases\PurchasesController@destroy', 'purchase' => $purchase->id]]) }}
          <div class="btn-group">
           <a href="{{ action('Purchases\PurchasesController@edit', ['purchase' => $purchase->id]) }}" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete</button>
          </div>
        {{ Form::close() }}
      </div>
    </div>
    <br><small>Sta. mesa Manila</small>
  </h1>


    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('po_number', 'Reference #:') }}
        {{ Form::text('po_number', $purchase->po_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>          
      {{--<div class="form-group col-md-4">
        {{ Form::label('agent_id', 'Sales Agent:') }}
        {{ Form::text('agent_id', $purchase->agent->first_name.' '.$purchase->agent->last_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>    --}}
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('supplier_id', 'Supplier:') }}
        {{ Form::text('supplier_id', $purchase->supplier->supplier_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('supplier_company', 'Company') }}
        {{ Form::text('supplier_company', $purchase->supplier->company_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_tel', 'Telephone') }}
        {{ Form::text('supplier_tel', $purchase->supplier->tel_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('supplier_address', 'Address') }}
        {{ Form::text('supplier_address', $purchase->supplier->street_address, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_fax', 'Fax') }}
        {{ Form::text('supplier_tel', $purchase->supplier->fax_num, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

<!-- ADDING QUOTATION LINE ITEMS -->
<!-- REMOVE IF STATUS IS PENDING APPROVAL --> 
<?php if ($purchase->billing_status == 'Draft') { ?>
  {{ Form::open(['action' => ['Purchases\PurchasesController@attachItem'], 'files' => true, 'role' => 'form']) }}
    {{ Form::hidden('purchase_id', $purchase->id ) }}
    <div class="row">
      <div class="form-group col-md-3">
        {{ Form::label('item_id', 'Item') }}
        {{ Form::select('item_id', ['' => 'Select Item'] + $items, '', ['class' => 'form-control', 'id' => 'item-id']) }}
      </div>  
      <div class="form-group col-md-2">
        {{ Form::label('item_qty', 'Qty') }}
        {{ Form::text('item_qty', '1', ['class' => 'form-control']) }}
      </div>      
      <div class="form-group col-md-3">
        {{ Form::label('item_price', 'Item Price') }}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
          {{ Form::text('item_price','', ['class' => 'form-control', 'item_price']) }}
        </div>
      </div>
      {{--<div class="form-group col-md-3">
        {{ Form::label('line_discount', 'Line Discount') }}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
          {{ Form::text('line_discount','0', ['class' => 'form-control']) }}
        </div>
      </div>--}}
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
        <th>Line Price</th>
        <?php if ($purchase->billing_status == 'Draft') { ?> 
          <th></th>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      @foreach ($purchase->items as $item)
        <tr>
          <td>{{ $item->model_number }}</td>
          <td>{{ $item->description }}</td>
          <td>{{ $item->dimensions }}</td>
          <td>{{ $item->pivot->quantity }}</td>
          <td>{{ $item->pivot->price }}</td>
          <td>{{ $item->pivot->line_total }}</td>
          <?php if ($purchase->billing_status == 'Draft') { ?> 
            <td> 
              {{ Form::open(['action' => ['Purchases\PurchasesController@detachItem'], 'files' => true, 'role' => 'form']) }}
                  {{ Form::hidden('item_id', $item->id) }}
                  {{ Form::hidden('line_total', $item->pivot->line_total) }}
                  {{ Form::hidden('quotation_id', $purchase->id) }}  
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
  // $purchase->grand_total = Total of all items. VAT INCLUSIVE
  // $purchase->net_total = Total of all items less discount. VAT INCLUSIVE
  //
  $totalLessVAT = round(($purchase->grand_total*$purchase->tax/(100+$purchase->tax)), 2);
  $discountedAmount = $purchase->grand_total - ($purchase->grand_total *((100-$purchase->discount)/100)); 
  $discountedVAT = round(($purchase->net_total*$purchase->tax/(100+$purchase->tax)), 2); //extract VAT from Discounted Price
?>
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

        <br />
        <br />
        <br />
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
             
    </div>
  </div>
  <?php if ($purchase->billing_status == 'Draft') { ?>
     {{ Form::model($purchase, ['method' => 'put', 'action' => ['Purchases\PurchasesController@update', $purchase->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'PendingApproval')}}
      <button type="submit" class="btn btn-success pull-right">
        <i class="fa fa-save"></i> Send For Approval
      </button>
     {{ Form::close() }}
  <?php } ?>

  <?php if ($purchase->billing_status == 'PendingApproval' || $purchase->billing_status == 'SalesOrder') { ?>
  <div class="row">
    <div class="col-md-10"></div>
    <div class="col-md-1">
    {{ Form::model($purchase, ['method' => 'put', 'action' => ['Purchases\PurchasesController@update', $purchase->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'Draft')}}
      <button type="submit" class="btn btn-warning">
        <i class="fa fa-save"></i> Return
      </button>
     {{ Form::close() }}  
  </div>
  <div class="col-md-1">
     {{ Form::model($purchase, ['method' => 'put', 'action' => ['Purchases\PurchasesController@update', $purchase->id], 'role' => 'form']) }}
      {{ Form::hidden('billing_status' ,'Approved')}}
      <button type="submit" class="btn btn-success">
        <i class="fa fa-save"></i> Approve
      </button>
     {{ Form::close() }}  
  </div>
</div>
  <?php } ?>

  <?php if ($purchase->billing_status == 'Approved') { ?>
      {{ Form::model($purchase, ['method' => 'put', 'action' => ['Purchases\PurchasesController@createSI', $purchase->id], 'role' => 'form']) }}
        {{ Form::hidden('billing_status' ,'SalesOrder')}}
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
