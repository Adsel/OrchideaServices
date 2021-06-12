<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class LotteryResult extends Eloquent {
    protected $table = 'Lottery_Result';
    protected $primaryKey = 'result_id';
    protected $fillable = [
        'datetime', 'rewards'
    ];
    public $timestamps = false;
}
