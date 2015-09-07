
@extends ('layouts.admin')

@section ('body')

  <a href="{{ action('Sales\QuotationsController@salesordershow', ['$quotation->id'])}}"><i class="fa fa-arrow-left"></i> Back to Sales Order</a>
  <h1 class="page-header"><i class="fa fa-user"></i> DOORTECH SYSTEM
    <div class="pull-right"> 
      <small>{{ $quotation->date }}</small>
    </div>
    <br><small>48 7th Avenue., near Main Ave., Cubao, Quezon City</small>
  </h1>

  {{ Form::open(['action' => ['Sales\CollectionsController@store'], 'files' => true, 'role' => 'form']) }}

      {{ Form::hidden('quotation_id', $quotation->id) }}
      <div class="row">
        <div class="form-group col-md-4">
          {{ Form::label('so_number', 'SO#:') }}
          {{ Form::text('so_number', $quotation->so_number, ['class' => 'form-control', 'disabled' => 'disabled']) }}
        </div>
        <div class="form-group col-md-3">
          {{ Form::label('date', 'Collection Date:') }}
          <div class="input-append date input-group" id="dp" data-date="{{ date('Y-m-d') }}" data-date-format="yyyy-mm-dd">
            <span class="add-on input-group-addon"><i class="fa fa-calendar"></i></span>
            <input class="form-control" type="text" value="{{ date('Y-m-d') }}" readonly="" name="date">
          </div>
        </div>
      </div>
      <div class="row">
        <div class="form-group col-md-4 {{ $errors->has('cr_id') ? 'has-error' : ''}} ">
          {{ Form::label('cr_id', 'Collection Receipt#:') }}
          {{ Form::text('cr_id', null, ['class' => 'form-control']) }}
          @if ($errors->has('cr_id'))
            <span class="help-block">{{$errors->first('cr_id')}}</span>
          @endif
        </div> 
        <div class="form-group col-md-3 {{ $errors->has('collected_by') ? 'has-error' : ''}}">
          {{ Form::label('collected_by', 'Collected By') }}
          {{ Form::text('collected_by', null, ['class' => 'form-control']) }}
          @if ($errors->has('collected_by'))
            <span class="help-block">{{$errors->first('collected_by')}}</span>
          @endif
        </div>    
      </div>
      <div class="row">
        <div class="form-group col-md-3 {{ $errors->has('amount') ? 'has-error' : ''}}">
          {{ Form::label('amount', 'Amount') }}
          {{ Form::text('amount', null, ['class' => 'form-control']) }}
          @if ($errors->has('amount'))
            <span class="help-block">{{$errors->first('amount')}}</span>
          @endif
        </div>
      </div>
    <button type="submit" class="btn btn-success pull-right">
      <i class="fa fa-save"></i> Save
    </button>
    {{ Form::close() }}

    <script>
      $('#dp').datepicker();
    </script>
@stop

