<?php

use Watson\Validating\ValidatingTrait;

class Tax extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'name' => 'required|max:255',
        'rate' => 'required|numeric|max:255',
        'comments' => 'numeric|max:255',

    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'rate'];

    public function quotation()
    {
        return $this->hasMany('Quotation');
    }

    public function purchase()
    {
        return $this->hasMany('Purchase');
    }
}


