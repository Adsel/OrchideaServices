<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class MainAchievement extends Eloquent {
    protected $table = 'Main_Achievement';
    protected $primaryKey = 'id';
    protected $fillable = [
        'content'
    ];
    public $timestamps = false;
}
