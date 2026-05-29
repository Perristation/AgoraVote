<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ElectionSection extends Model
{
    protected $fillable = [
        'election_id',
        'title',
        'description',
        'max_selections',
    ];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function options()
    {
        return $this->hasMany(VoteOption::class);
    }
}