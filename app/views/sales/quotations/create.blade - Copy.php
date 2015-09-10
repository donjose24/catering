@extends ('layouts.master')
@section ('content')

  <a href="{{ action('Sales\QuotationsController@index')}}"><i class="fa fa-arrow-left"></i> Back to Quotation Listings</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <div class="pull-right"> 
      <small>{{ date('F d, Y') }}</small>
    </div>
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>
  </h1>

  {{ Form::open(['action' => ['Sales\QuotationsController@store'], 'files' => true, 'role' => 'form']) }}
    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('client_id', 'To:') }}
        {{ Form::select('client_id', ['' => 'Select Client'] + $clients, '', ['class' => 'form-control']) }}
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


<!-- ITEMS -->
    <div class="col-md-12"><hr></div>
    <div class="col-md-12">
      <div class="col-md-6">
        {{ Form::select('item_id', ['' => 'Select Item to Add'] + $itemselect, '', ['class' => 'form-control', 'id' => 'item_id']) }}
      </div>
      <button type="button" onClick="addItem(this.form);" class="btn btn-default col-md-6"><i class="fa fa-plus"></i> Add Item</button>
    </div>
    <div class="col-md-12" id="item_holder">
      <table class="table table-responsive table-striped">
        <thead>
          <tr>
            <th>ID</th>
            <th>Model</th>
            <th>Details</th>
            <th class="col-md-1">Qty</th>
            <th class="col-md-1">Price</th>
            <th>Amount</th>
            <th></th>
          </tr>
        </thead>
        <tbody id="item_line">

        </tbody>
      </table>
    </div>


<!--  TERMS AND TOTAL --> 
    <div class="col-md-12"><hr></div>
    <div class="form-horizontal col-md-6">
      <div class="form-group">
        {{ Form::label('terms', 'Terms', ['class' => 'col-md-1 control-label']) }}
        <div class="col-md-3">
          <div class="input-group">
            {{ Form::text('terms', null, ['class' => 'form-control']) }}
            <span class="input-group-addon">days</span>
          </div>
        </div>
      </div>
    </div>

    <div class="form-horizontal col-md-6">
      <div class="form-group">
        {{ Form::label('sub_total', 'Sub Total', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <p><i class="fa fa-rub fa-lg"></i></p>
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
      <div class="form-group">
        {{ Form::label('net_total', 'Net Total', ['class' => 'col-md-3 control-label']) }}
        <div class="col-md-3">
          <p><i class="fa fa-rub fa-lg"></i></p>
        </div>
      </div>
    </div>
     
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>


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

    var itemCount = 0;
    function addItem () {
      itemCount++;
      var selectedItem = $('#item_id option:selected');
      console.dir(selectedItem);
      console.dir(selectedItem.val());
      $.post(
        "{{ url ('items/items/getOne') }}",
        { option: selectedItem.val() },
        function (data) {
          console.dir(data);
          var row = '<tr id="itemNum'+itemCount+'">';
          row += '<td>"'+data.id+'"</td>';
          row += '<td>"'+data.model_number+'"</td>';
          row += '<td>"'+data.description+'"</td>';
          row += '<td><input type="text" name="quantity" value="0" class="form-control"></td>';
          row += '<td><input type="text" name="price" value="0" class="form-control"></td>';
          row += '<td><p id="line_total"></p></td>';
          row += '<td><a href="" type="button" onclick="removeRow('+itemCount+');" class="btn btn-danger"><i class="fa fa-trash-o"></i></a></td></tr>';
          jQuery('#item_line').append(row);
          
        });

    }



    function removeRow(iNum){
      jQuery('#itemNum'+iNum).remove();
    }

</script>

@stop
