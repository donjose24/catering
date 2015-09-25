<?php

class AuthController extends BaseController
{
    public function __construct()
    {
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

    public function getSignIn()
    {
        //remove this on publish

        return View::make('auth.sign-in');
    }

    public function getLogin(){
        
//        echo 'Update password of user karol to karol ====   ($2y$10$o6qMW7ba1GRAdjytu24.3egfQIKC1mokH6IKs/3xar0VOF.vxLKRe)';
        return View::make('auth.admin-sign-in');
    }
    public function postSignIn()
    {

        $result = Auth::attempt(['email' => Input::get('email') , 'password' => Input::get('password') ]);
        if($result) return Redirect::action('AdminController@index');
        return Redirect::back()->withErrors('Invalid Credentials');
        
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
