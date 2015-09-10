@extends ('layouts.admin')

@section ('body')
  <a href="{{ action('Items\ItemTypesController@index') }}"><i class="fa fa-arrow-left"></i> Back to Item Categories</a>
  <h1 class="page-header"><i class="fa fa-client"></i> {{ $itemtype->name }}
    <div class="pull-right">
    {{ Form::open(['method' => 'delete',  'action' => ['Items\ItemTypesController@destroy', 'itemtype' => $itemtype->id]]) }}
      <div class="btn-group">
        <a href="{{ action('Items\ItemTypesController@edit', ['itemtype' => $itemtype->id]) }}" class="btn btn-warning"> <i class="fa fa-edit fa-lg"></i> Edit</a>
      </div>
        <div class="btn-group">
          <button class="btn btn-danger" type="submit"> <i class="fa fa-trash-o fa-lg"></i> Delete</button>
        </div>
      {{ Form::close() }}
    </div>
  </h1>

        <div class="form-group">
          {{ Form::label('name', 'Name', array('class' => 'control-label')) }}
          {{ Form::text('name', $itemtype->name, array('class' => 'form-control', 'disabled' => 'disabled')) }}
        </div>
        <div class="form-group">
          {{ Form::label('description', 'Description') }}
          {{ Form::text('description', $itemtype->description, array('class' => 'form-control' , 'disabled' => 'disabled')) }}
        </div>

@stop
