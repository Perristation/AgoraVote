<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class)
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    public function elections()
    {
        return $this->belongsToMany(Election::class)->withTimestamps();
    }

    public function participations()
    {
        return $this->hasMany(Participation::class);
    }
}