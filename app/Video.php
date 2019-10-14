<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $primaryKey = 'v_id';
    protected $fillable = ['v_name','v_detail','v_img','v_imdb','v_view','v_tags','v_type','v_trailer','v_movie','v_view'];
}