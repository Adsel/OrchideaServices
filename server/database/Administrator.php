<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Administrator extends Eloquent {
    protected $table = 'Administrator';
    protected $primaryKey = 'id';
    protected $fillable = [
        'visible_name', 'login', 'password', 'role_id'
    ];

}
