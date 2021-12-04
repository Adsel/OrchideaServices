<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class AchievementType extends Eloquent
{
    protected $table = 'achievement_type';
    protected $primaryKey = 'achievement_type_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'award_currency',
        'award_gold'
    ];

}
