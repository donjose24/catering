<?php

use Watson\Validating\ValidatingTrait;

class Receiving extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    public static $rules = [
        'reference_number'   => 'required',
        'date'               => 'required|date',
        'received_by'        => 'required|max:50',
    ];

    protected $dates = ['deleted_at'];

    public function purchase()
    {
        return $this->belongsTo('Purchase');
    }

    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity');
    }
}
