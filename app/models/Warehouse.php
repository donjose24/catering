<?php

use Watson\Validating\ValidatingTrait;

class Warehouse extends Eloquent
{
    //use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'name'                  => 'required|max:100',
        'description'           => 'max:100',
        'street_address'        => 'max:255',
        'city'                  => 'max:255',
        'state'                 => 'max:255',
        'zip_code'              => 'max:255',
        'country'               => 'max:255',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description', 'street_address', 'city', 'state','zip_code', 'country'];

    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity');
    }

}
