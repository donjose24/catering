<?php
/**
 * Created by PhpStorm.
 * User: Renz
 * Date: 1/23/2015
 * Time: 12:49 PM
 */

class Menu extends Eloquent{

    protected $fillable = ['first_name', 'last_name', 'client_address', 'contact', 'motif','venue_address','event','date_request','event_start','event_end','reservation_start','reservation_end'];
    protected $table = 'menu';

    
} 