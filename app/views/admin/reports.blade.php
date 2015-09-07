@extends('layouts.admin')

@section('title')
    <b>Sales Report</b>
@stop

@section('body')

<script>

</script>
<hr>
{{Form::open(['action' => 'AdminController@generateReport'])}}
<div class="row">
    <div class="col-lg-7">
         {{Form::radio('choice', 'weekly');}} Weekly

    </div>
    <div class="col-lg-6">
        <p>Start Date:</p>
       <input type="date" name="start" class="form-control">
    </div>
        <div class="col-lg-6">
        <p>End Date:</p>
           <input type="date" name="end" class="form-control">
        </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-7">
         {{Form::radio('choice', 'monthly');}} Monthly

    </div>
    <div class="col-lg-6" style="padding-left:5em">
        {{Form::selectMonth('month','',['class' => 'form-control']);}}
    </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-7">
          {{Form::radio('choice', 'yearly');}} Yearly

    </div>
     <div class="col-lg-6" style="padding-left:5em">
            {{Form::selectRange('year', 2000, date_format(Carbon::now(), 'Y'),['class' => 'form-control'],['class' => 'form-control'])}}
     </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-7">
    <h3>Status:</h3>
    {{Form::select('status', array('All' => 'All Reservations', 'Payment Pending' => 'Payment Pending', 'Cancelled' => 'Cancelled', 'Down Payment' => 'Down Payment', 'Approved' => 'Fully Paid','Event End' => 'Event End', 'Event Ongoing' => 'Event Ongoing'),'',['class' => 'form-control']);}}
     </div>
</div>
<hr>
<div class="row">
    <div class="col-lg-12">
        <input class="form-control btn btn-info btn-lg" type="submit" value="Generate Report" target = "_blank">
    </div>
</div>


@stop