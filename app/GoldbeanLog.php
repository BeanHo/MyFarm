<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GoldbeanLog extends Model
{
    protected $fillable = [
        'user_id', 'type', 'num'
    ];
}
