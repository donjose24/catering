@extends ('layouts.admin')
@section ('body')
  {{ Form::model($quotation, ['method' => 'put', 'action' => ['Sales\QuotationsController@update', $quotation->id], 'role' => 'form']) }}

  <a href="{{ action('Sales\QuotationsController@index')}}"><i class="fa fa-arrow-left"></i> Back to Quotation Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <div class="pull-right"> 
      <small>{{ Form::text('date', date('F d, Y'), ['class' => 'form-control']) }}</small>
    </div>
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>
  </h1>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('quotation_number', 'Reference #:') }}
        {{ Form::text('quotation_number', null, ['class' => 'form-control']) }}
      </div>    
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('client_id', 'To:') }}
        {{ Form::select('client_id', ['' => 'Select Client'] + $clients, $quotation->client_id, ['class' => 'form-control']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('client_company', 'Company') }}
        <input type="text" id='client_company' class="form-control" disabled="disabled"/ >
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_tel', 'Telephone') }}
        <input type="text" id='client_tel' class="form-control" disabled="disabled" />
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('client_address', 'Address') }}
        <input type="text" id='client_address' class="form-control" disabled="disabled" />
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('client_fax', 'Fax') }}
        <input type="text" id='client_fax' class="form-control" disabled="disabled" />
      </div>
    </div>

<!--  TERMS AND TOTAL --> 
    <div class="col-md-12"><hr></div>
    <div class="form-horizontal col-md-6">
      <div class="form-group">
        {{ Form::label('terms', 'Terms', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('terms', null, ['class' => 'form-control']) }}
            <span class="input-group-addon">days</span>
          </div>
        </div>
      </div>
      <div class="form-group">
        {{ Form::label('tax', 'Tax', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('tax', null, ['class' => 'form-control']) }}
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>      
      <div class="form-group">
        {{ Form::label('discount', 'Discount', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('discount', null, ['class' => 'form-control']) }}
            <span class="input-group-addon">%</span>
          </div>
        </div>
      </div>

    </div>

    <div class="form-horizontal col-md-6">
     
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
       
    </div>


  {{ Form::close() }}


<script>
    $('#client_id')
    .change(function() {
      $.post(
        "{{ url ('settings/clients/getOne') }}",
        { option: $(this).val() },
        function (data) {
          console.dir(data);
          console.dir(data.company_name);
          $('#client_tel').val(data.tel_num);
          $('#client_fax').val(data.fax_num);
          $('#client_address').val(data.street_address + " " + data.city);
          $('#client_company').val(data.company_name);

        });
    }); 

</script>

@stop
