<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $primaryKey = 'm_id';
    protected $fillable = ['m_iframe','m_vid'];
}
