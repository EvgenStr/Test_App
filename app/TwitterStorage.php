<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TwitterStorage extends Model
{
    protected $casts = [
        'hashtags' => 'array',
        'urls' => 'array',
    ];
}
