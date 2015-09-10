@extends ('layouts.admin')

@section('title')
  <a href="{{ action('Settings\AgentsController@index') }}"><i class="fa fa-arrow-left"></i> Back to Agents</a>

  <h1 class="page-header"><i class="fa fa-user"></i> Sales Agent</h1>
@stop

@section ('body')


  <div class="row">
    <div class="form-group col-md-4">
      {{ Form::label('first_name', 'First Name', array('class' => 'control-label')) }}
      {{ Form::text('first_name', $agent->first_name, array('class' => 'form-control', 'disabled' => 'disabled')) }}
    </div>
    <div class="form-group col-md-4">
      {{ Form::label('last_name', 'Last Name') }}
      {{ Form::text('last_name', $agent->last_name, array('class' => 'form-control' , 'disabled' => 'disabled')) }}
    </div>
    <div class="form-group col-md-4">
      {{ Form::label('employee_number', 'Employee Number') }}
      {{ Form::text('employee_number', $agent->employee_number, array('class' => 'form-control' , 'disabled' => 'disabled')) }}
    </div>
  </div>
    <div class="form-group">
      {{ Form::label('notes', 'Notes') }}
      {{ Form::textarea('notes', $agent->notes, array('class' => 'form-control' , 'disabled' => 'disabled')) }}
    </div>

  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>SO#</th>
        <th>Quote#</th>
        <th>Date</th>
        <th>Client</th>
        <th>Total</th>
        <th>Billing Status</th>
        <th>Delivery Status</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($agent->quotations as $quotation)
        <tr>
          <td>{{ $quotation->so_number }}</td>
          <td>{{ $quotation->quotation_number }}</td>
          <td>{{ $quotation->date }}</td>
          <td>{{ $quotation->client->customer_name }}</td>
          <td>{{ $quotation->net_total }}</td>
          <td>{{ $quotation->billing_status }}</td>
          <td>{{ $quotation->delivery_status }}</td>
          <td> 
            <a href="{{ action('Sales\QuotationsController@salesordershow', $quotation->id) }}">Show Details</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
