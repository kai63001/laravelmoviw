<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anime extends Model
{
    protected $primaryKey = 'a_id';
    protected $fillable = ['a_name','a_iframe','a_vid'];
}
