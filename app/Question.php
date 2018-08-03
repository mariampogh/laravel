<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'profession_id', 'question'
    ];

    public function profession()
    {
        return $this->belongsTo('Laravel\Profession');
    }
}
