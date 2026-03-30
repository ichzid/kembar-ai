<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PersonaSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'tone_style',
        'verbosity',
        'audience_default',
        'guardrails',
    ];

    protected $casts = [
        'tone_style' => 'array',
        'audience_default' => 'array',
        'guardrails' => 'array',
    ];

    public function persona(): BelongsTo
    {
        return $this->belongsTo(Persona::class);
    }
}
