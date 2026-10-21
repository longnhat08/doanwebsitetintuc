<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = ['name', 'email', 'password', 'role'];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = ['password' => 'hashed'];

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
