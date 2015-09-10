<?php

use Watson\Validating\ValidatingTrait;

class Quotation extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'quotation_number'          => 'required|max:50',
        'so_number'                 => 'max:50',
        'si_number'                 => 'max:50',
        'terms'                     => 'max:50',
        'date'                      => 'required|max:255',
        'prepared_by'               => 'required|max:50',
        'agent_id'                  => 'required',
        'client_id'                 => 'required',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['quotation_number', 'notes', 'billing_status', 'installation_status', 'agent_id', 'so_number','si_number','grand_total', 'net_total', 'date', 'prepared_by', 'terms', 'tax', 'discount', 'prepared_by', 'client_id'];

    public function client()
    {
        return $this->belongsTo('Client');
    }
    public function agent()
    {
        return $this->belongsTo('Agent');
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

    public function deliveries()
    {
        return $this->hasMany('Delivery');
    }

    public function collections()
    {
        return $this->hasMany('Collection');
    }

    public function items()
    {
        return $this->belongsToMany('Item')->withPivot('quantity', 'price', 'line_total', 'delivered_quantity', 'line_discount', 'sub_total');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($quotation){
            $quotation->items()->detach();
            $quotation->collections()->delete();
            $quotation->deliveries()->delete();

        });

    }
}
