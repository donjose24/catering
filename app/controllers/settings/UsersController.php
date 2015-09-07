<?php namespace Settings;

use BaseController;
use Input;
use Redirect;
use User;
use View;

class UsersController extends BaseController
{
    public function __construct()
    {
        //$this->beforeFilter('auth');
        //$this->beforeFilter('csrf', ['on' => 'post']);
    }

    public function index()
    {
        return View::make('settings.users.index')
            ->withUsers(User::get());
    }

    public function create()
    {
        return View::make('settings.users.create');
    }

    public function store()
    {
        $user           = new User;
        $user->email    = Input::get('email');
        $user->password = Input::get('password');
        $user->is_admin = Input::get('is_admin');

        if ($user->save()) {
            return Redirect::action('Settings\UsersController@index');
        } else {
            return Redirect::action('Settings\UsersController@create')
                ->withInput()
                ->withErrors($user->errors());
        }
    }

    public function show(User $user)
    {
        return View::make('settings.users.show')
            ->withUser($user);
    }

    public function edit(User $user)
    {
        return View::make('settings.users.edit')
            ->withUser($user);
    }

    public function update(User $user)
    {
        $rules          = User::$rules;
        $user->email    = Input::get('email');
        $user->is_admin = Input::get('is_admin');

        if ($newPassword = Input::get('new_password')) {
            dd($newPassword);
            $user->password = $newPassword;
        } else {
            unset($rules['password']);
        }

        if ($user->save($rules)) {
            return Redirect::action('Settings\UsersController@show', $user->id);
        } else {
            return Redirect::action('Settings\UsersController@edit', $user->id)
                ->withInput();
        }
    }

    public function destroy(User $user)
    {
        if ($user->delete()) {
            return Redirect::action('Settings\UsersController@index');
        } else {
            return Redirect::action('Settings\UsersController@show', $user->id);
        }
    }
}
