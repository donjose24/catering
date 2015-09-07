@extends ('layouts.master')

@section ('content')
  <h1 class="page-header"><i class="fa fa-users"></i> Users</h1>
  <table class="table table-responsive table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Email</th>
        <th>Admin?</th>
        <th><a href="{{ action('Settings\UsersController@create') }}"><i class="fa fa-plus"></i> Create</a></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $user->id }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->is_admin ? 'Yes' : 'No' }}</td>
          <td>
            <a href="{{ action('Settings\UsersController@show', ['user' => $user->id]) }}">Show</a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@stop
