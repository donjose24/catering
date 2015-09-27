@extends ('layouts.admin')

@section ('body')
	<h1>Broken</h1>
    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('id', 'Reservation #:') }}
        {{ Form::text('id', $reservation->id, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-4">
        {{ Form::label('supplier_id', 'Name:') }}
        {{ Form::text('supplier_id', $reservation->last_name . ', ' . $reservation->first_name, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
      <div class="form-group col-md-4">
        {{ Form::label('supplier_company', 'Client Address') }}
        {{ Form::text('supplier_company', $reservation->client_address, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_tel', 'Contact') }}
        {{ Form::text('supplier_tel', $reservation->contact, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>

    <div class='row'>
      <div class="form-group col-md-8">
        {{ Form::label('supplier_address', 'Motif') }}
        {{ Form::text('supplier_address', $reservation->motif, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>

      <div class="form-group col-md-4">
        {{ Form::label('supplier_fax', 'Status') }}
        {{ Form::text('supplier_tel', $reservation->status, ['class' => 'form-control', 'disabled' => 'disabled']) }}
      </div>
    </div>
    <hr>

<hr >

{{ Form::open(['action' => ['AdminController@brokenAdditionalItem'], 'files' => true, 'role' => 'form']) }}
    {{ Form::hidden('reservation_id', $reservation->id ) }}
    <div class="row">
      <div class="form-group col-md-3">
        {{ Form::label('item_id', 'Item') }}
        <select id="item-id-get" name="item_id_get" class="form-control">
            @foreach($item as $items)
                <option value="{{$items->id}}">{{ucwords($items->model_number)}} </option>
            @endforeach

        </select>
      </div>
      <div class="form-group col-md-2">
        {{ Form::label('quantity', 'Qty') }}
        {{ Form::text('quantity', '1', ['class' => 'form-control']) }}
      </div>
      <div class="form-group col-md-3">
        {{ Form::label('price', 'Item Price') }}
        <div class="input-group">
          <span class="input-group-addon"><i class="fa fa-rub"></i></span>
          <input type="text" id="item_price" name="item_price" class="form-control" readonly>
        </div>
      </div>
      <div class="form-group col-md-1">
          <button type="submit" class="btn btn-success btn-lg" id="button-add-line-item">Add <i class="fa fa-level-down"></i></button>
        </div>
      </div>
{{ Form::close() }}
<hr>
<table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>Model#</th>
        <th>Description</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Line Price</th>

      </tr>
    </thead>


    <tbody>
      @foreach ($reservation->broken as $item)
       <?php $menu = Item::find($item->menu_id);  ?>
        <tr>
                  <td>{{ $menu->model_number }}</td>
                  <td>{{ $menu->dimensions }}</td>
                  <td>{{ $menu->average_price }}</td>
                  <td>{{ $item->quantity }}</td>
                  <td>{{ ($item->quantity * 1) * ($menu->average_price * 1) }}</td>

                    <td>
                      {{ Form::open(['action' => ['AdminController@detachBrokenItem'], 'files' => true, 'role' => 'form']) }}
                          {{ Form::hidden('item_id', $item->id) }}
                          {{ Form::hidden('quantity', $item->quantity) }}
                          {{ Form::hidden('average_price', $menu->average_price) }}
                          {{ Form::hidden('reservation_id', $reservation->id) }}
                            <button type="submit" class="btn btn-danger pull-right">
                              <i class="fa fa-trash-o"></i>
                            </button>
                      {{ Form::close() }}
                    </td>

                </tr>
      @endforeach


    </tbody>
  </table>
<script>
	function getPrice() {
      $.post("{{ url ('menu/getPrice') }}",
        { option: $('#item-id').val() },
        function (data) {
          $('#price').val(data.price);
        });
    } 
	
	function getID() {
      $.post(
        "{{ url ('item/getPrice') }}",
        { option: $('#item-id-get').val() },
        function (data) {
          $('#item_price').val(data.average_price);
        });
    }

    $('#item-id').change(getPrice);

    $('#item-id-get').change(getID);

	$(document).ready(function(){
		getPrice();
		getID();
	});
</script>
@stop
