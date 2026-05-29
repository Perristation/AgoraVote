<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VoteOption extends Model
{
    protected $fillable = [
        'election_section_id',
        'text',
        'sort_order',
        'is_active',
    ];

    public function section()
    {
        return $this->belongsTo(ElectionSection::class, 'election_section_id');
    }

    public function votes()
    {
        return $this->belongsToMany(Vote::class, 'vote_option')->withTimestamps();
    }
}