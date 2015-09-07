<?php
use Watson\Validating\ValidatingTrait;

class Agent extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'first_name'         => 'required|max:100',
        'last_name'          => 'required|max:100',
        'employee_number'    => 'required|max:100',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['first_name', 'last_name', 'employee_number', 'notes'];

    public function quotations()
    {
        return $this->hasMany('Quotation');
    }

    public static function boot()
    {
        parent::boot();

        static::deleted(function($agent)
        {
            $$agent->quotations()->delete();
        });
    }
}
