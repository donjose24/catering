<!doctype html>
<html>
  <head>
    <!-- Bootstrap -->
    <link href="{{ asset('bower_components/datepicker/css/datepicker.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/bootswatch/cerulean/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bower_components/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet">
  </head>
  <body style="background: url('{{asset('forms/salesorderform.jpg')}}') no-repeat; width:612px; height:792px;">
  	<div style="position: absolute;top: 100px;left: 120px;width: 443px;font-size: 10px;   white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
      {{ $quotation->client->customer_name }}
      {{ $quotation->client->street_address }}
      {{ $quotation->client->city }}
      {{ $quotation->client->tel_num }}
      {{ $quotation->quotation_number }}
    </div>
    <div style="position: absolute;top: 100px;left: 120px;width: 443px;font-size: 10px;   white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
      Lord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdfLord jka slkd fjalksdfh lsakjdfh alskjd hfsalkjdhf lksajdhf lsajkhdf
    </div>  
    @foreach( $quotation->items() as $item)
      {{ $item->quantity }}
      {{ $item->model_number }} {{ $item->description }} {{ $item->dimensions }}
    @endforeach


  </body>
</html>
