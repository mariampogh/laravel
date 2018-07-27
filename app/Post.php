<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
     protected $fillable = [
        'post_name', 'post',
    ];

 
}
