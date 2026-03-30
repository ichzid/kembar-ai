<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Persona extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'persona_name',
        'persona_description',
        'role_summary',
        'default_language',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function knowledge(): HasMany
    {
        return $this->hasMany(PersonaKnowledge::class);
    }

    public function settings(): HasOne
    {
        return $this->hasOne(PersonaSetting::class);
    }

    public function whatsappAccount(): HasOne
    {
        return $this->hasOne(WhatsappAccount::class);
    }
}
