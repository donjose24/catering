@extends ('layouts.admin')

@section ('body')
    <a href="{{ action('Items\ItemsController@index') }}"><i class="fa fa-arrow-left"></i> Back to Items</a>
    <h1 class="page-header"><i class="fa fa-client"></i> {{ $item->model_number }} <small> {{ $item->description }} </small>
        <div class="pull-right">
            {{ Form::open(['method' => 'post',  'action' => ['Items\ItemsController@adjustInventory', 'item' => $item->id]]) }}

            <div class="btn-group">
                <button class="btn btn-primary" type="submit"> Save</button>
            </div>

        </div>
    </h1>
    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('total_quantity', 'Total Quantity', array('class' => 'control-label')) }}
            {{ Form::number('total_quantity', $item->total_quantity, array('class' => 'form-control')) }}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('allocated_quantity', 'Allocated Quantity') }}
            {{ Form::number('allocated_quantity', $item->allocated_quantity, array('class' => 'form-control')) }}
        </div>
    </div>

    {{ Form::close() }}
@stop
