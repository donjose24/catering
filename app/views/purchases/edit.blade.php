@extends ('layouts.admin')
@section ('body')
  {{ Form::model($purchase, ['method' => 'put', 'action' => ['Purchases\PurchasesController@update', $purchase->id], 'role' => 'form']) }}

 <a href="{{ action('Purchases\PurchasesController@show', ['purchase' => $purchase->id])}}"><i class="fa fa-arrow-left"></i> Back to Purchases</a>
  <h1 class="page-header"><i class="fa fa-user"></i> INVENTORY SYSTEM
    <br><small>Sta. Mesa Manila</small>

        <div class="input-append date input-group pull-right col-md-2" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
          <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
          <input class="form-control" type="text" value="{{ date('Y-m-d') }}" readonly="" name="date">
        </div>
  </h1>



    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('po_number', 'Reference #:') }}
        {{ Form::text('po_number', null, ['class' => 'form-control']) }}
      </div>
      {{--<div class="form-group col-md-4">
        {{ Form::label('agent_id', 'Sales Agent:') }}
        {{ Form::select('agent_id', ['' => 'Select Sales Agent'] + $agents, '', ['class' => 'form-control']) }}
      </div> --}}
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('supplier_id', 'To:') }}
        {{ Form::select('supplier_id', ['' => 'Select Supplier'] + $suppliers, '', ['class' => 'form-control']) }}
      </div>    
      <div class="form-group col-md-4">
        {{ Form::label('supplier_company', 'Company') }}
        <input type="text" id='supplier_company' class="form-control" disabled="disabled"/ >
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_tel', 'Telephone') }}
        <input type="text" id='supplier_tel' class="form-control" disabled="disabled" />
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('supplier_address', 'Address') }}
        <input type="text" id='supplier_address' class="form-control" disabled="disabled" />
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_fax', 'Fax') }}
        <input type="text" id='supplier_fax' class="form-control" disabled="disabled" />
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
            {{ Form::text('tax', '12', ['class' => 'form-control']) }}
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
    {{ Form::hidden('billing_status', 'Draft') }}
    <div class="form-horizontal col-md-6">
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
       
    </div>


  {{ Form::close() }}


<script>
    $('#supplier_id')
    .change(function() {
      $.post(
        "{{ url ('settings/suppliers/getOne') }}",
        { option: $(this).val() },
        function (data) {
          console.dir(data);
          console.dir(data.company_name);
          $('#supplier_tel').val(data.tel_num);
          $('#supplier_fax').val(data.fax_num);
          $('#supplier_address').val(data.street_address + " " + data.city);
          $('#supplier_company').val(data.company_name);

        });
    }); 

</script>

@stop
