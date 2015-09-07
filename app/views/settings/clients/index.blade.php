@extends ('layouts.admin')
@section('title')
  <h1 class="page-header"><i class="fa fa-clients"></i> Clients</h1>
@stop
@section ('body')

  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Customer</th>
        <th>Company</th>
        <th>Telephone</th>
        <th>Email</th>
        <th><a href="{{ action('Settings\ClientsController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($clients as $client)
        <tr>
          <td>{{ $client->id }}</td>
          <td>{{ $client->customer_name }}</td>
          <td>{{ $client->company_name }}</td>
          <td>{{ $client->tel_num }}</td>
          <td>{{ $client->email }}</td>
          <td>
            <a href="{{ action('Settings\ClientsController@show', ['client' => $client->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
