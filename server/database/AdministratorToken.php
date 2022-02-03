<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdministratorToken extends Eloquent
{
    protected $table = 'administrator_token';
    protected $primaryKey = 'administrator_token_id';
    public $timestamps = false;

    protected $fillable = [
        'token',
        'expiration_at',
        'admin_id'
    ];
}
