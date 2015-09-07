<?php
use Watson\Validating\ValidatingTrait;

class Client extends Eloquent
{
    use SoftDeletingTrait;
    use ValidatingTrait;

    protected $rules = [
        'customer_name'         => 'required|max:30',
        'company_name'          => 'max:100',
        'street_address'        => 'max:255',
        'city'                  => 'max:255',
        'state'                 => 'max:255',
        'zip_code'              => 'max:255',
        'country'               => 'max:255',
        'tel_num'               => 'required|max:15',
        'alt_tel_num'           => 'max:15',
        'fax_num'               => 'max:15',
        'email'                 => 'max:50|email',
        'contact_person'        => 'max:50',
        'designation'           => 'max:255',
        'notes'                 => 'max:255',
    ];

    protected $dates = ['deleted_at'];

    protected $fillable = ['customer_name', 'company_name', 'street_address', 'city', 'state','zip_code', 'country', 'tel_num'
    , 'alt_tel_num', 'fax_num', 'email', 'contact_person', 'designation', 'notes'];

    public function quotations()
    {
        return $this->hasMany('Quotation');
    }
}
