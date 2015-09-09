<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 1/23/2015
 * Time: 1:26 PM
 */

class Reservation extends Eloquent{

    protected $fillable = ['id','first_name','pax','payment_mode','payment_method', 'last_name', 'client_address', 'contact', 'motif','venue_address','event','date_request','event_start','event_end','reservation_start','reservation_end'];
    protected $table = 'reservations';
<<<<<<< HEAD
    public $incrementing = false;
    public $rules = ['id' => 'unique:reservations'];
    public function rules(){
        return $this->rules;
    }
=======
>>>>>>> 4ba5cd4d3c1e2b31dca4424c57b755d7e8418bf5

    public function menus()
    {
        return $this->belongsToMany('Menu')->withPivot('day','package');
    }

    public function messages()
    {
        return $this->hasMany('Message');
    }
    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('qty');
    }

    public function additionals()
    {
        return $this->hasMany('Additional');
    }
    public function returns()
    {
        return $this->hasMany('Returns');
    }
    public function broken()
    {
        return $this->hasMany('Broken');
    }
}