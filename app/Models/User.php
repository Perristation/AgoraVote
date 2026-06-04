<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * Campos que se pueden rellenar de forma masiva.
     */
    protected $fillable = [
    'name',
    'dni',
    'email',
    'password',
    ];

    /**
     * Campos que se ocultan al convertir el modelo a array o JSON.
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversión automática de tipos.
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relación muchos a muchos entre usuarios y roles.
     * Un usuario puede tener varios roles: admin, votante, supervisor.
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Relación muchos a muchos entre usuarios y categorías.
     * Un usuario puede pertenecer a alumnado, profesorado, familias, etc.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class)
            ->withPivot('assigned_at')
            ->withTimestamps();
    }

    /**
     * Relación uno a muchos con las votaciones creadas por el usuario.
     * Normalmente las crea un administrador.
     */
    public function elections()
    {
        return $this->hasMany(Election::class, 'created_by');
    }

    /**
     * Relación uno a muchos con las participaciones del usuario.
     */
    public function participations()
    {
        return $this->hasMany(Participation::class);
    }

    /**
     * Relación uno a muchos con los registros de auditoría.
     */
    public function auditLogs()
    {
        return $this->hasMany(AuditLog::class);
    }

    /**
     * Comprueba si el usuario tiene un rol concreto.
     */
    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->exists();
    }
}