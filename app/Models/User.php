<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'avatar',
        'google_id',
        'email_verified_at',
        'leads_enabled',
        'contextual_cta_enabled',
        'contextual_cta_text',
        'admin_whatsapp_number',
    ];

    protected $hidden = [
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'leads_enabled' => 'boolean',
        'contextual_cta_enabled' => 'boolean',
    ];

    public function personas()
    {
        return $this->hasMany(Persona::class);
    }
}
