<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdditionalAchievement extends Eloquent {
    protected $table = 'Additional_Achievement';
    protected $primaryKey = 'name';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'name', 'content', 'level'
    ];

}
