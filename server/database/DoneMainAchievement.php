<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class DoneMainAchievement extends Eloquent {
    protected $table = 'Done_Main_Achievement';
    protected $primaryKey = 'id';
    protected $fillable = [
        'achievement_id', 'player', 'date', 'link', 'added_by'
    ];
}
