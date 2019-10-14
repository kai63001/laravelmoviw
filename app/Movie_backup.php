<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie_backup extends Model
{
    protected $primaryKey = 'mb_id';
    protected $fillable = ['mb_name','mb_iframe','mb_vid'];
}
