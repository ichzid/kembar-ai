<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecisionInbox extends Model
{
    use HasFactory;

    protected $fillable = [
        'persona_id',
        'lead_id',
        'detected_intent',
        'brand_name',
        'cooperation_type',
        'summary',
        'estimated_value',
        'status',
        'action_taken_at',
    ];

    protected $casts = [
        'action_taken_at' => 'datetime',
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
