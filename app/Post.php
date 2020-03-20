<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Post extends Model
{
    protected $fillable = ['event', 'from','to','schedule','created_at'];
}
