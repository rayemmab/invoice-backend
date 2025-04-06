<?php

namespace App\Models;

// Import des classes nécessaires
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',     
        'email',         
        'password',     
        'role',         // Rôle (admin/staff)
        'preferred_language', 
        'default_currency_id' 
    ];

    protected $hidden = [
        'password',        
        'remember_token',  
    ];

    protected $casts = [
        'email_verified_at' => 'datetime', 
        'role' => 'string',              
    ];

 
    public function defaultCurrency()
    {
        return $this->belongsTo(Currency::class, 'default_currency_id');
    }

    /**
     * Vérifie si l'utilisateur a un rôle admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

 
    public function isStaff(): bool
    {
        return $this->role === 'staff';
    }

    public function scopeOfRole($query, string $role)
    {
        return $query->where('role', $role);
    }

    /* Méthode pour définir le mot de passe (le hash automatiquement) */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}