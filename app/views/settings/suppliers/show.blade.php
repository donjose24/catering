@extends ('layouts.admin')
@section('title')
  <a href="{{ action('Settings\SuppliersController@index') }}"><i class="fa fa-arrow-left"></i> Back to Suppliers</a>

   <h1 class="page-header"><i class="fa fa-client"></i> <b>{{ $suppliers->supplier_name }}</b> <small> {{ $suppliers->company_name }} </small>
@stop
@section ('body')

    <div class="pull-right">
    {{ Form::open(['method' => 'delete',  'action' => ['Settings\SuppliersController@destroy', 'supplier' => $suppliers->id]]) }}
      <div class="btn-group">
        <a href="{{ action('Settings\SuppliersController@edit', ['supplier' => $suppliers->id]) }}" class="btn btn-warning"> <i class="fa fa-edit fa-lg"></i> Edit</a>
      </div>
        <div class="btn-group">
          <button class="btn btn-danger" type="submit"> <i class="fa fa-trash-o fa-lg"></i> Delete</button>
        </div>
      {{ Form::close() }}
    </div>
  </h1>
     <ul class="nav nav-tabs">
      <li class="active"><a href="#basic" data-toggle="tab">Basic Details</a></li>
      <li><a href="#advanced" data-toggle="tab">Advanced Details</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic">
        <br />
        <div class="form-group">
          {{ Form::label('supplier_name', 'Supplier Name', array('class' => 'control-label')) }}
          {{ Form::text('supplier_name', $suppliers->supplier_name, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group">
          {{ Form::label('company_name', 'Company') }}
          {{ Form::text('company_name', $suppliers->company_name, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group">
          {{ Form::label('tel_num', 'Telephone') }}
          {{ Form::text('tel_num', $suppliers->tel_num, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>

    <div class='row'>
        <table class="table table-responsive table-striped">
            <thead>
              <tr>
                <th>Date</th>
                <th>SO #</th>
                <th>SI #</th>
                <th>Total</th>
                <th>Status</th> 
              </tr>
            </thead>
            <tbody>
              @foreach ($suppliers->purchases as $purchases)
                <tr>
                  <td>{{ $purchases->date }}</td>
                  <td><a href="{{-- action('Sales\QuotationsController@salesordershow', [$quotation->id]) --}}">{{ $purchases->po_number }}</a></td>
                  <td>{{ $purchases->si_number }}</td>
                  <td>{{ $purchases->net_total }}</td>
                  <td>{{ $purchases->billing_status }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
    </div>
      </div>
      <div class="tab-pane" id="advanced">
        <br />
        <div class="form-group">
          {{ Form::label('contact_person', 'Contact Person') }}
          {{ Form::text('contact_person', $suppliers->contact_person, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group">
          {{ Form::label('designation', 'Designation') }}
          {{ Form::text('designation', $suppliers->designation, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Address</div>
          <div class="panel-body">
            <div class="form-group">
              {{ Form::label('street_address', 'Street Address', array('class' => 'sr-only')) }}
              {{ Form::text('street_address', $suppliers->street_address, array('class' => 'form-control', 'disabled' => 'disabled', 'id' => 'street_address', 'placeholder' => 'Street Address')) }}
            </div>
            <div class="form-inline">
              <div class="form-group">
                {{ Form::label('city', 'City', array('class' => 'sr-only')) }}
                {{ Form::text('city', $suppliers->city, array('class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'City')) }}
              </div>
              <div class="form-group">
                {{ Form::label('state', 'State', array('class' => 'sr-only')) }}
                {{ Form::text('state', $suppliers->state, array('class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'State')) }}
              </div>
              <div class="form-group">
                {{ Form::label('zip_code', 'Zip Code', array('class' => 'sr-only')) }}
                {{ Form::text('zip_code', $suppliers->zip_code, array('class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'Zip Code')) }}
              </div>
              <div class="form-group">
                {{ Form::label('country', 'Country', array('class' => 'sr-only')) }}
                {{ Form::text('Country', $suppliers->country, array('class' => 'form-control', 'disabled' => 'disabled', 'placeholder' => 'Country')) }}
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Other Contact Numbers</div>
          <div class="panel-body">
              <div class="form-group">
                {{ Form::label('alt_tel_num', 'Alternate Telephone') }}
                {{ Form::text('alt_tel_num', $suppliers->alt_tel_num, array('class' => 'form-control', 'disabled' => 'disabled')) }}
              </div>
              <div class="form-group">
                {{ Form::label('fax_num', 'Fax') }}
                {{ Form::text('fax_num', $suppliers->fax_num, array('class' => 'form-control', 'disabled' => 'disabled')) }}
              </div>
              <div class="form-group">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', $suppliers->email, array('class' => 'form-control', 'disabled' => 'disabled')) }}
              </div>
            </div>
          </div>
          <div class="form-group">
            {{ Form::label('notes', 'Notes') }}
            {{ Form::textarea('notes', $suppliers->notes, array('class' => 'form-control', 'disabled' => 'disabled')) }}
          </div>
        </div>
      </div>
  <div class="tab-content">
    <div class="tab-pane active" id="basic">
@stop
