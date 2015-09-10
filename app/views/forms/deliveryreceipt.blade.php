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

    {{ $delivery->quotation->client->customer_name }}
    {{ $delivery->quotation->so_number }}
    {{ $delivery->date }}
    {{ $delivery->quotation->client->street_address }}
    {{ $delivery->quotation->client->city }}
    {{ $delivery->quotation->client->tel_num }}

    @foreach ($delivery->items() as $item)
      {{ $item->pivot->quantity }}
      {{ $item->model_number }} {{ $item->description }} {{ $item->dimensions }}
    @endforeach
  </body>
</html>
