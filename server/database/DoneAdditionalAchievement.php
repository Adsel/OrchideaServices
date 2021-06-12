<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class DoneAdditionalAchievement extends Eloquent {
    protected $table = 'Done_Additional_Achievement';
    protected $primaryKey = 'id';
    protected $fillable = [
        'achievement_name', 'player', 'date', 'link', 'added_by'
    ];

}
