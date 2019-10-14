<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class tag extends Model
{
    protected $primaryKey = 't_id';
    protected $fillable = ['t_name'];
}
