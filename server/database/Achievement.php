<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Achievement extends Eloquent
{
    protected $table = 'achievement';
    protected $primaryKey = 'achievement_id';
    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'category',
        'type_id',
        'order_number'
    ];

    public function achievementType(): HasOne
    {
        return $this->hasOne('AchievementType', 'achievement_type_id', 'type_id');
    }
}
