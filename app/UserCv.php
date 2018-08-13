<?php

namespace Laravel;

use Illuminate\Database\Eloquent\Model;

class UserCv extends Model
{
    protected $fillable = [
        'user_id', 'question', 'answear'
    ];

	public function user()
    {
        return $this->belongsTo('Laravel\User');
    }
}
