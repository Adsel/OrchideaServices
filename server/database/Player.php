<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Player extends Eloquent {
    protected $table = 'Saved_Player';
    protected $primaryKey = 'id';
    protected $fillable = [
        'profile_id', 'nickname', 'description'
    ];
    public $timestamps = false;
}
