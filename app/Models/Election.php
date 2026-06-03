<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Election extends Model
{
    protected $fillable = [
        'created_by',
        'title',
        'description',
        'start_at',
        'end_at',
        'status',
        'is_anonymous',
        'show_realtime_results',
        'voting_type',
        'max_selections',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function sections()
    {
        return $this->hasMany(ElectionSection::class);
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    public static function closeExpired(): void
    {
        self::where('status', 'active')
            ->whereNotNull('end_at')
            ->where('end_at', '<=', now())
            ->update(['status' => 'closed']);
    }
}