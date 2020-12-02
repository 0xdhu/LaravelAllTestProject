<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categori extends Model
{
    protected $table = 'categories';
    protected $fillable = [
        'channelName', 'programs', 'hlsUrlPhoneAUTO', 'stillImageName', 'under19Content', 'serviceId','genreCd','state'
    ];
}
