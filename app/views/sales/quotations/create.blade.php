@extends ('layouts.admin')
@section ('body')
  {{ Form::open(['action' => ['Sales\QuotationsController@store'], 'files' => true, 'role' => 'form']) }}

  <a href="{{ action('Sales\QuotationsController@index')}}"><i class="fa fa-arrow-left"></i> Back to Quotation Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>

        <div class="input-append date input-group pull-right col-md-2" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
          <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" type="text" value="{{ date('Y-m-d') }}" readonly="" name="date">
        </div>
  </h1>

    <div class='row'>
      <div class="form-group {{ $errors->has('quotation_number') ? 'has-error' : ''}} col-md-4">
        {{ Form::label('quotation_number', 'Reference #:') }}
        {{ Form::text('quotation_number', null, ['class' => 'form-control', 'placeholder' => '0000000']) }}
        @if ($errors->has('quotation_number'))
          <span class="help-block">{{$errors->first('quotation_number')}}</span>
        @endif
      </div>     
      <div class="form-group {{ $errors->has('agent_id') ? 'has-error' : ''}} col-md-4">
        {{ Form::label('agent_id', 'Sales Agent') }}
        {{ Form::select('agent_id', ['' => 'Select Sales Agent'] + $agents, '', ['class' => 'form-control']) }}
        @if ($errors->has('agent_id'))
          <span class="help-block">{{$errors->first('agent_id')}}</span>
        @endif
      </div>    
    </div>

    <div class='row'>
      <div class="form-group col-md-1">
        <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#createClient">New</button>
      </div>
      <div class="form-group {{ $errors->has('client_id') ? 'has-error' : ''}} col-md-4">
        {{ Form::label('client_id', 'To:') }}
        {{ Form::select('client_id', ['' => 'Select Client'] + $clients, '', ['class' => 'form-control']) }}
        @if ($errors->has('client_id'))
          <span class="help-block">{{$errors->first('client_id')}}</span>
        @endif
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('client_company', 'Company') }}
        <input type="text" id='client_company' class="form-control" disabled="disabled"/ >
      </div>

      <div class="form-group col-md-3">
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
      <div class="form-group {{ $errors->has('terms') ? 'has-error' : ''}}">
        {{ Form::label('terms', 'Terms', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('terms', '0', ['class' => 'form-control']) }}
            <span class="input-group-addon">days</span>
            @if ($errors->has('terms'))
              <span class="help-block">{{$errors->first('terms')}}</span>
            @endif
          </div>
        </div>
      </div>
      <div class="form-group {{ $errors->has('tax') ? 'has-error' : ''}}">
        {{ Form::label('tax', 'Tax', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('tax', '12', ['class' => 'form-control']) }}
            <span class="input-group-addon">%</span>
            @if ($errors->has('tax'))
              <span class="help-block">{{$errors->first('tax')}}</span>
            @endif            
          </div>
        </div>
      </div>      
      <div class="form-group {{ $errors->has('discount') ? 'has-error' : ''}}">
        {{ Form::label('discount', 'Discount', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('discount', '0', ['class' => 'form-control']) }}
            <span class="input-group-addon">%</span>
            @if ($errors->has('discount'))
              <span class="help-block">{{$errors->first('discount')}}</span>
            @endif
          </div>
        </div>
      </div>

    </div>
    {{ Form::hidden('billing_status', 'Draft') }}
    <div class="form-horizontal col-md-6">
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
       
    </div>
      {{ Form::close() }}


    <div class="modal fade" id="createClient" tabindex="-1" role="dialog" aria-labelledby="modalHeader" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <h4 class="modal-title" id="modalHeader">Create New Client</h4>
            <div class="modal-body">
              {{ Form::open(['action' => 'Settings\ClientsController@storeModal', 'role' => 'form']) }}
                <div class="form-group {{ $errors->has('customer_name') ? 'has-error' : ''}}">
                  {{ Form::label('customer_name', 'Customer Name', array('class' => 'control-label')) }}
                  {{ Form::text('customer_name', null, array('class' => 'form-control')) }}
                  @if ($errors->has('customer_name'))
                    <span class="help-block">{{$errors->first('customer_name')}}</span>
                  @endif
                </div>
                <div class="form-group  {{ $errors->has('company_name') ? 'has-error' : ''}}">
                  {{ Form::label('company_name', 'Company') }}
                  {{ Form::text('company_name', null, array('class' => 'form-control')) }}
                  @if ($errors->has('company_name'))
                    <span class="help-block">{{$errors->first('company_name')}}</span>
                  @endif
                </div>
                <div class="form-group {{ $errors->has('tel_num') ? 'has-error' : ''}}">
                  {{ Form::label('tel_num', 'Telephone') }}
                  {{ Form::text('tel_num', null, array('class' => 'form-control')) }}
                  @if ($errors->has('tel_num'))
                    <span class="help-block">{{$errors->first('tel_num')}}</span>
                  @endif
                </div>
                 <div class="panel panel-default">
                  <div class="panel-heading">Address</div>
                  <div class="panel-body">
                    <div class="form-group {{ $errors->has('street_address') ? 'has-error' : ''}}">
                      {{ Form::label('street_address', 'Street Address', array('class' => 'sr-only')) }}
                      {{ Form::text('street_address', null, array('class' => 'form-control', 'id' => 'street_address', 'placeholder' => 'Street Address')) }}
                    </div>
                    @if ($errors->has('street_address'))
                          <span class="help-block">{{$errors->first('street_address')}}</span>
                    @endif 
                    <div class="form-inline">
                      <div class="form-group">
                        {{ Form::label('city', 'City', array('class' => 'sr-only')) }}
                        {{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City')) }}
                      </div>
                      <div class="form-group">
                        {{ Form::label('state', 'State', array('class' => 'sr-only')) }}
                        {{ Form::text('state', null, array('class' => 'form-control', 'placeholder' => 'State')) }}
                      </div>
                      <div class="form-group">
                        {{ Form::label('zip_code', 'Zip Code', array('class' => 'sr-only')) }}
                        {{ Form::text('zip_code', null, array('class' => 'form-control', 'placeholder' => 'Zip Code')) }}
                      </div>
                      <div class="form-group">
                        {{ Form::label('country', 'Country', array('class' => 'sr-only')) }}
                        {{ Form::text('Country', 'Philippines', array('class' => 'form-control', 'placeholder' => 'Country')) }}
                      </div>
                                               
                        @if ($errors->has('city'))
                          <span class="help-block">{{$errors->first('city')}}</span>
                        @endif                        
                        @if ($errors->has('state'))
                          <span class="help-block">{{$errors->first('state')}}</span>
                        @endif                        
                        @if ($errors->has('zip_code'))
                          <span class="help-block">{{$errors->first('zip_code')}}</span>
                        @endif                        
                        @if ($errors->has('country'))
                          <span class="help-block">{{$errors->first('country')}}</span>
                        @endif
                    </div>
                  </div>
                </div>
            </div>
               <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success pull-right"><i class="fa fa-save"></i> Save</button>
                {{ Form::close() }}
              </div>
          </div>
        </div>
      </div>
    </div>


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
    $('#dp').datepicker();


     if ({{ Input::old('autoOpenModal', 'false') }}) {
        $('#createClient').modal('show');
    }
</script>

@stop
