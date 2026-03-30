<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsappAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'persona_id',
        'provider',
        'provider_app_id',
        'provider_secret_key',
        'phone_number',
        'status',
        'qr_code',
        'session_data',
        'last_connected_at',
    ];

    protected $casts = [
        'last_connected_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }
}
