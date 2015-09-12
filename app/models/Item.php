<?php

use Watson\Validating\ValidatingTrait;

class Item extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'model_number'              => 'required|max:255',
        'description'               => 'required|max:255',
        'dimensions'                => 'max:255',
        'average_price'             => 'required|numeric',
        'total_quantity'            => 'integer',
        'alert_quantity'            => 'required|integer',
        'itemtype_id'               => 'required|max:255',
    ];
    protected $table = 'items';
    protected $dates = ['deleted_at'];

    protected $fillable = ['uom', 'model_number', 'description', 'average_price', 'alert_quantity', 'dimensions', 'total_quantity', 'alert_quantity', 'itemtype_id', 'allocated_quantity'];

    public function quotations()
    {
        return $this->belongsToMany('Quotation')->withPivot('quantity', 'price', 'line_total', 'delivered_quantity', 'line_discount', 'sub_total');
    }

    public function deliveries()
    {
        return $this->belongsToMany('Delivery')->withPivot('quantity');
    }

    public function itemtype()
    {
        return $this->belongsTo('ItemType', 'itemtype_id', 'id');
    }

    public function purchases()
    {
        return $this->belongsToMany('Purchase');
    }

    public function receivings()
    {
        return $this->belongsToMany('Receiving')->withPivot('quantity');
    }

    public function warehouses()
    {
        return $this->belongsToMany('Warehouse')->withPivot('quantity');
    }

    public function reservations()
    {
        return $this->belongsToMany('Reservation')->withPivot('');
    }
}
