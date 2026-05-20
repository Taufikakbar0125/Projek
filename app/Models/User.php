<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // --- Role Helpers ---

    public function isSuperAdmin(): bool
    {
        return $this->role === 'super_admin';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    /**
     * Cek apakah user memiliki minimal role tertentu.
     * Dipakai oleh MaintenanceCheckMiddleware dan AdminMiddleware.
     *
     * @param string $minRole  'staff' | 'admin' | 'super_admin'
     */
    public function hasMinRole(string $minRole): bool
    {
        $levels = ['super_admin' => 3, 'admin' => 2, 'staff' => 1];
        return ($levels[$this->role] ?? 0) >= ($levels[$minRole] ?? 1);
    }
}
