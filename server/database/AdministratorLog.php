<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class AdministratorLog extends Eloquent {
    protected $table = 'administrator_log';
    protected $primaryKey = ' administrator_log_id';
    public $timestamps = true;

    protected $fillable = [
        'administrator_id',
        'administrator_ip',
        'action_type',
        'action_data',
        'created_at',
    ];
}
