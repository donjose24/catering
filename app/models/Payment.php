<?php
use Watson\Validating\ValidatingTrait;

class Payment extends Eloquent {

    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'payment_receipt'  => 'required|unique:payments',
        'amount'           => 'required',
        'collected_by'     => 'required',
    ];
    protected $softDelete = true;
    protected $dates = ['deleted_at'];

    protected $fillable = ['payment_receipt', 'amount', 'id', 'collected_by', 'date'];

    public function purchase()
    {
        return $this->belongsTo('Purchase');
    }

} 