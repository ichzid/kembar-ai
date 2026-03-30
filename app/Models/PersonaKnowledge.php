<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaKnowledge extends Model
{
    use HasFactory;

    protected $table = 'persona_knowledge';

    protected $fillable = [
        'persona_id',
        'type',
        'content',
        'source',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}
