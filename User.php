<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Spatie\Permission\Traits\HasRoles;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, Billable, HasRoles;

    protected $fillable = [
        'name', 'email', 'password', 'phone',
        'role', 'bar_number', 'specialization',
        'income', 'is_verified', 'preferred_language',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_verified'       => 'boolean',
        'income'            => 'decimal:2',
    ];

    // A client can have many cases
    public function cases()
    {
        return $this->hasMany(LegalCase::class, 'client_id');
    }

    // A lawyer can be assigned many cases
    public function assignedCases()
    {
        return $this->hasMany(LegalCase::class, 'lawyer_id');
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'sender_id');
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class, 'client_id');
    }

    public function forumPosts()
    {
        return $this->hasMany(ForumPost::class);
    }
}
