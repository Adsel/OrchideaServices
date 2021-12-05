<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class AchievementDone extends Eloquent
{
    protected $table = 'achievement_done';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'achievement_id',
        'player_id',
        'accepted_at'
    ];

    public function achievement(): HasOne
    {
        return $this->hasOne('Achievement', 'achievement_id', 'achievement_id');
    }

}
