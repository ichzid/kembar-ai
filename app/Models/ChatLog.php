<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'lead_id',
        'from_type',
        'message',
        'context_snapshot',
    ];

    protected $casts = [
        'context_snapshot' => 'array',
        'created_at' => 'datetime',
    ];

    public function persona()
    {
        return $this->belongsTo(Persona::class);
    }

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }
}
