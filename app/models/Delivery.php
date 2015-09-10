<?php

use Watson\Validating\ValidatingTrait;

class Delivery extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'reference_number'          => 'required|unique:deliveries',
        'delivery_date'             => 'required|date',
        'delivered_by'              => 'required|max:50',
    ];

    protected $dates = ['deleted_at'];

    public function quotation()
    {
        return $this->belongsTo('Quotation');
    }

    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity');
    }
}
