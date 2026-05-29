<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vote extends Model
{
    protected $fillable = [
        'participation_id',
        'registered_at',
        'encrypted_value',
    ];

    public function participation()
    {
        return $this->belongsTo(Participation::class);
    }

    public function options()
    {
        return $this->belongsToMany(VoteOption::class, 'vote_option')->withTimestamps();
    }
}