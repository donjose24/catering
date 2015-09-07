<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 2/1/2015
 * Time: 6:50 PM
 */

class Category extends Eloquent{
    protected $dates = ['deleted_at'];
    protected $table = "category";

    public function menus()
    {
        return $this->hasMany('Menu');
    }
} 