<?php
use Watson\Validating\ValidatingTrait;

class Collection extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected  $rules = [
        'cr_id'          => 'required|unique:collections',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['cr_id', 'amount', 'id', 'collected_by', 'date'];

    public function quotation()
    {
        return $this->belongsTo('Quotation');
    }
}
