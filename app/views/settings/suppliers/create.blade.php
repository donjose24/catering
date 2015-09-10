@extends ('layouts.admin')
@section('title')
   <small><a href="{{ action('Settings\SuppliersController@index') }}"><i class="fa fa-arrow-left"></i> Back to Suppliers</a></small>
  <h1 class="page-header"><i class="fa fa-user"></i> Add Supplier Record</h1>
@stop
@section ('body')



  {{ Form::open(['action' => 'Settings\SuppliersController@store', 'role' => 'form']) }}
    <ul class="nav nav-tabs">
      <li class="active"><a href="#basic" data-toggle="tab">Basic Details</a></li>
      <li><a href="#advanced" data-toggle="tab">Advanced Details</a></li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane active" id="basic">
        <br />
        <div class="form-group {{ $errors->has('supplier_name') ? 'has-error' : ''}}">
          {{ Form::label('supplier_name', 'Name') }}
          {{ Form::text('supplier_name', null, array('class' => 'form-control')) }}
          @if ($errors->has('supplier_name'))
            <span class="help-block">{{$errors->first('supplier_name')}}</span>
          @endif
        </div>
        <div class="form-group {{ $errors->has('company_name') ? 'has-error' : ''}}">
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
      </div>
      <div class="tab-pane" id="advanced">
        <br />
        <div class="form-group {{ $errors->has('contact_person') ? 'has-error' : ''}}">
          {{ Form::label('contact_person', 'Contact Person') }}
          {{ Form::text('contact_person', null, array('class' => 'form-control')) }}

          @if ($errors->has('contact_person'))
            <span class="help-block">{{$errors->first('contact_person')}}</span>
          @endif
        </div>
        <div class="form-group {{ $errors->has('designation') ? 'has-error' : ''}}">
          {{ Form::label('designation', 'Designation') }}
          {{ Form::text('designation', null, array('class' => 'form-control')) }}

          @if ($errors->has('designation'))
            <span class="help-block">{{$errors->first('designation')}}</span>
          @endif
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Address</div>
          <div class="panel-body">
            <div class="form-group {{ $errors->has('street_address') ? 'has-error' : ''}}">
              {{ Form::label('street_address', 'Street Address', array('class' => 'sr-only')) }}
              {{ Form::text('street_address', null, array('class' => 'form-control', 'id' => 'street_address', 'placeholder' => 'Street Address')) }}
            </div>
            <div class="form-inline">
              <div class="form-group {{ $errors->has('city') ? 'has-error' : ''}}">
                {{ Form::label('city', 'City', array('class' => 'sr-only')) }}
                {{ Form::text('city', null, array('class' => 'form-control', 'placeholder' => 'City')) }}
              </div>
              <div class="form-group {{ $errors->has('state') ? 'has-error' : ''}}">
                {{ Form::label('state', 'State', array('class' => 'sr-only')) }}
                {{ Form::text('state', null, array('class' => 'form-control', 'placeholder' => 'State')) }}
              </div>
              <div class="form-group {{ $errors->has('zip_code') ? 'has-error' : ''}}">
                {{ Form::label('zip_code', 'Zip Code', array('class' => 'sr-only')) }}
                {{ Form::text('zip_code', null, array('class' => 'form-control', 'placeholder' => 'Zip Code')) }}
              </div>
              <div class="form-group {{ $errors->has('country') ? 'has-error' : ''}}">
                {{ Form::label('country', 'Country', array('class' => 'sr-only')) }}
                {{ Form::text('country', 'Philippines', array('class' => 'form-control', 'placeholder' => 'Country')) }}
              </div>
            </div>
          </div>
        </div>
        <div class="panel panel-default">
          <div class="panel-heading">Other Contact Numbers</div>
          <div class="panel-body">
              <div class="form-group {{ $errors->has('alt_tel_num') ? 'has-error' : ''}}">
                {{ Form::label('alt_tel_num', 'Alternate Telephone') }}
                {{ Form::text('alt_tel_num', null, array('class' => 'form-control')) }}

          @if ($errors->has('alt_tel_num'))
            <span class="help-block">{{$errors->first('alt_tel_num')}}</span>
          @endif
              </div>
              <div class="form-group {{ $errors->has('fax_num') ? 'has-error' : ''}}">
                {{ Form::label('fax_num', 'Fax') }}
                {{ Form::text('fax_num', null, array('class' => 'form-control')) }}

          @if ($errors->has('fax_num'))
            <span class="help-block">{{$errors->first('fax_num')}}</span>
          @endif
              </div>
              <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {{ Form::label('email', 'Email') }}
                {{ Form::email('email', null, array('class' => 'form-control')) }}

          @if ($errors->has('email'))
            <span class="help-block">{{$errors->first('email')}}</span>
          @endif
              </div>
            </div>
          </div>
          <div class="form-group {{ $errors->has('notes') ? 'has-error' : ''}}">
            {{ Form::label('notes', 'Notes') }}
            {{ Form::textarea('notes', null, array('class' => 'form-control')) }}

          @if ($errors->has('notes'))
            <span class="help-block">{{$errors->first('notes')}}</span>
          @endif
          </div>
        </div>
      </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
  {{ Form::close() }}
@stop
