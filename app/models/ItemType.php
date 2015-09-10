<?php

use Watson\Validating\ValidatingTrait;

class ItemType extends Eloquent
{
    //use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'name'          => 'required|max:255',
        'description'   => 'required|max:255',

    ];
    protected $table = 'itemtypes';
    protected $dates = ['deleted_at'];

    protected $fillable = ['name', 'description'];

    public function items()
    {
        return $this->hasMany('Item', 'itemtype_id', 'id');
    }
}


