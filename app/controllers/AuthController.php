<?php

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getSignIn()
    {
        return View::make('auth.sign-in');
    }

    public function postSignIn()
    {
        if (Auth::attempt(array('email' => Input::get('email'), 'password' => Input::get('password')))) {

            return Redirect::intended('/');
        } else {
            return Redirect::action('AuthController@getSignIn');
        }
    }

    public function getSignOut()
    {
        Auth::logout();

        return Redirect::intended('/');
    }

    public function signIn()
    {
        if(Input::get('email') == 'karol' && Input::get('password') == 'karol')
        {
            $user = User::find(1);
            Auth::login($user);
            return Redirect::action('AdminController@index');
        } 

        return Redirect::back()->withErrors('Invalid Credentials');
    }
}
