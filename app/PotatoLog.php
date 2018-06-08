<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PotatoLog extends Model
{
    protected $fillable = [
        'user_id', 'setting_id', 'num'
    ];
}
