<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Watson\Validating\ValidatingTrait;

class User extends Eloquent implements UserInterface, RemindableInterface
{
    use RemindableTrait;
    use SoftDeletingTrait;
    use UserTrait;
    use ValidatingTrait;

    protected $rules = [
        'email'    => 'required|email|max:255',
        'password' => 'required|min:8',
        'is_admin' => '',
    ];

    protected $dates = ['deleted_at'];
    protected $table = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $fillable = ['password'];
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

    public function organizations()
    {
        return $this->belongsToMany('Organization', 'organizers');
    }
}
