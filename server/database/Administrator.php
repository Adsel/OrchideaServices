<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Administrator extends Eloquent
{
    protected $table = 'administrator';
    protected $primaryKey = 'administrator_id';
    public $timestamps = false;

    protected $fillable = [
        'login',
        'password',
        'visible_name'
    ];
}
