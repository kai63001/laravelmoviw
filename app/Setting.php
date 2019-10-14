<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $primaryKey = 's_id';
    protected $fillable = [
        's_title',
        's_logo',
        's_des',
        's_keyword',
        's_bg',
        's_maincolor',
        's_fanpage',
        's_coverplayer',

    ];
}
