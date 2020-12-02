<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commongenres extends Model
{
    protected $table = 'commongenres';
    protected $fillable = [
        'cdName','state'
    ];
}
