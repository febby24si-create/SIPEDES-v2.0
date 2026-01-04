<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'avatar',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Automatically hash password when setting - UNCOMMENT INI
     */
    // public function setPasswordAttribute($value)
    // {
    //     $this->attributes['password'] = Hash::make($value);
    // }

    /**
     * Check if user is admin
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Check if user is operator
     */
    public function isOperator()
    {
        return $this->role === 'operator';
    }

    /**
     * Check if user is user
     */
    public function isUser()
    {
        return $this->role === 'user';
    }

    /**
     * Get avatar URL
     */
    public function getAvatarUrlAttribute()
    {
        if ($this->avatar && Storage::disk('public')->exists('avatars/' . $this->avatar)) {
            return asset('storage/avatars/' . $this->avatar);
        }

        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    /**
     * Get role display name
     */
    public function getRoleDisplayAttribute()
    {
        $roles = [
            'admin' => 'Administrator',
            'operator' => 'Operator',
            'user' => 'User'
        ];

        return $roles[$this->role] ?? 'User';
    }
}
