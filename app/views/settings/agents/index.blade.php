@extends ('layouts.admin')

@section('title')
<h1 class="page-header"><i class="fa fa-clients"></i> Agents</h1>
@stop

@section ('body')

  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Employee #</th>
        <th>Name</th>
        <th><a href="{{ action('Settings\AgentsController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($agents as $agent)
        <tr>
          <td>{{ $agent->id }}</td>
          <td>{{ $agent->employee_number }}</td>
          <td>{{ $agent->first_name }} {{ $agent->last_name }}</td>
          <td>
            <a href="{{ action('Settings\AgentsController@show', ['agent' => $agent->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
