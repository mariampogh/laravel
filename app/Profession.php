<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $fillable = [
        'profession',
    ];
    public function questions()
    {
        return $this->hasMany('Laravel\Question');
    }


}
