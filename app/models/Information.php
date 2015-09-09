<?php

use Watson\Validating\ValidatingTrait;

class Information extends Eloquent
{
    public $table = 'information';
    protected $rules = [
        'keyname' => 'required|max:255',
        'value' => 'required|numeric|max:255',

    ];
    protected $dates = ['deleted_at', 'updated_at' ,'created_at'];
    protected $fillable = ['keyname', 'value'];
}
