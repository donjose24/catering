@extends('layouts.admin')

@section('title')
    <b>Inventory Report</b>
@stop

@section('body')

<script>

</script>
<hr>
{{Form::open(['action' => 'AdminController@generateInventoryReport'])}}

<div class="row">
    <div class="col-lg-7">
    <h3>Status:</h3>
    {{Form::select('status', array('All' => 'Inventory', 'Broken' => 'Broken', 'Returned' => 'Returned'),'',['class' => 'form-control']);}}
     </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <input class="form-control btn btn-info btn-lg" type="submit" value="Generate Report" target = "_blank">
    </div>
</div>


@stop