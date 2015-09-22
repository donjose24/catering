@extends('layouts.home')

@section('content-head')
<div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

                 <h4 class="modal-title">User Sign-in</h4>

            </div>
            <div class="modal-body">
                <div class="te">
                    {{Form::open(['action' => 'AuthController@postSignIn' , 'method' => 'post'])}}
                   <div class="account-wall">
                        <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                            alt="">
                    </div>
                    <hr>
                    <div class="form-group">
                     <label> Username:</label>
                            <input type="text" class="form-control" name="email" placeholder="Username" required autofocus>
                        </div>
                        <div class="form-group">
                        <label> Password:</label>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success btn-lg"><span class="fa fa-sign-in"></span> Sign In</button>
                 {{Form::close()}}
            </div>
        </div>

    </div>
@stop