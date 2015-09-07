<!doctype html>
<html>
  <head>
    <!-- Bootstrap -->
    <link href="{{ asset('bower_components/datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bootswatch/cerulean/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
  </head>
  <body style="background: url('{{asset('forms/sales order Form.jpg')}}') no-repeat; width:612px; height:792px;">
  	<div style="position: absolute;top: 100px;left: 120px;width: 443px;font-size: 10px;   white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
  		Lord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdf
  	</div>	

      {{ $quotation->client->customer_name }}
      {{ $quotation->client->street_address }}
      {{ $quotation->client->city }}
      {{ $quotation->client->tel_num }}
      {{ $quotation->quotation_number }}
      {{ $quotation->agent->first_name }} {{ $quotation->agent->last_name}}
      {{ $quotation->date }}
    </div>
    <div style="position: absolute;top: 100px;left: 120px;width: 443px;font-size: 10px;   white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
      Lord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdf
    </div>  
    @foreach( $quotation->items() as $item)
      {{ $item->pivot->quantity }}
      {{ $item->model_number }} {{ $item->description }} {{ $item->dimensions }}
      {{ $item->pivot->price }} {{ $item->pivot->line_discount }} {{ $item->pivot->line_price }}
    @endforeach


<?php 
  // $quotation->grand_total = Total of all items. VAT INCLUSIVE
  // $quotation->net_total = Total of all items less discount. VAT INCLUSIVE
  //
  $totalLessVAT = round(($quotation->grand_total*$quotation->tax/(100+$quotation->tax)), 2);
  $discountedAmount = $quotation->grand_total - ($quotation->grand_total *((100-$quotation->discount)/100)); 
  $discountedVAT = round(($quotation->net_total*$quotation->tax/(100+$quotation->tax)), 2); //extract VAT from Discounted Price
?>

    
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

  </body>
</html>
