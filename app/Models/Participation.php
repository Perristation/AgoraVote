<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participation extends Model
{
    protected $fillable = [
        'user_id',
        'election_id',
        'category_id',
        'voted_at',
        'verification_code',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function vote()
    {
        return $this->hasOne(Vote::class);
    }
}