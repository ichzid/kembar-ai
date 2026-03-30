<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'name',
        'phone',
        'email',
        'address',
        'city',
        'interest',
        'purpose',
        'audience_type',
        'details',
        'source',
        'conversation_stage',
        'last_interaction_at',
    ];

    protected $casts = [
        'last_interaction_at' => 'datetime',
        'details' => 'array',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function chatLogs()
    {
        return $this->hasMany(ChatLog::class);
    }
}
