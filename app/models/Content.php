<?php
class Content extends Eloquent
{
    
   
    protected $table ='content';
    protected $dates = ['deleted_at'];
    protected $fillable = ['content', 'user_id' , 'title'];

}
