<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent {
    protected $table = 'Role';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name', 'shortcut', 'description'
    ];
}
