<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime_backup extends Model
{
    protected $primaryKey = 'ab_id';
    protected $fillable = ['ab_name','ab_iframe','ab_aid'];
}
