<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    protected $primaryKey = 'ad_id';
    protected $fillable = ['ad_name','ad_img','ad_url'];
}
