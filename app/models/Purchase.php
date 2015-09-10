<?php

use Watson\Validating\ValidatingTrait;

class Purchase extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'po_number'                 => 'required|max:50',
        'si_number'                 => 'max:50',
        'terms'                     => 'max:50',
        'date'                      => 'required|date|max:255',
        'prepared_by'               => 'required|max:50',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['si_number','supplier_id','date','terms','tax','discount','grand_total','net_total','prepared_by','approved_by','billing_status','delivery_status'];

    public function supplier()
    {
        return $this->belongsTo('Supplier');
    }

    public function tax()
    {
        return $this->belongsTo('Tax');
    }

    public function discount()
    {
        return $this->belongsTo('discount');
    }

    public function terms()
    {
        return $this->belongsTo('terms');
    }

    public function receivings()
    {
        return $this->hasMany('Receiving');
    }

    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity', 'price', 'line_total', 'delivered_quantity');
    }

    public function payments()
    {
        return $this->hasMany('Payment');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($purchase)
        {
            $purchase->items()->detach();
            $purchase->receivings()->delete();
            $purchase->payments()->delete();
        });
    }

}
