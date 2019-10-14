<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReportVideo extends Model
{
    protected $primaryKey = 'r_id';
    protected $fillable = ['r_name','r_img','r_vid','r_aid'];
}
