<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ChatLog;
use App\Models\DecisionInbox;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WebhookController extends Controller
{
    /**
     * Ingest Lead Data from n8n
     * Endpoint: POST /api/webhook/leads
     */
    public function ingestLead(Request $request)
    {
        // Validasi input sederhana
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'phone'      => 'required|string',
            'name'       => 'nullable|string',
            'city'       => 'nullable|string',
            'purpose'    => 'nullable|string',
            'audience_type' => 'nullable|string',
            'details'    => 'nullable|array',
        ]);

        try {
            // Cari Lead existing atau buat instance baru
            $lead = Lead::firstOrNew([
                'persona_id' => $request->persona_id,
                'phone'      => $request->phone,
            ]);

            // Merge details (preserve existing keys unless updated)
            $existingDetails = $lead->details ?? [];
            $newDetails = $request->details ?? [];
            $mergedDetails = array_merge($existingDetails, $newDetails);

            // Update field hanya jika ada di request, kalau tidak pakai nilai lama
            $lead->fill([
                'name'                => $request->name ?? $lead->name,
                'email'               => $request->email ?? $lead->email,
                'address'             => $request->address ?? $lead->address,
                'city'                => $request->city ?? $lead->city,
                'interest'            => $request->interest ?? $lead->interest,
                'purpose'             => $request->purpose ?? $lead->purpose,
                'audience_type'       => $request->audience_type ?? $lead->audience_type,
                'details'             => $mergedDetails,
                'source'              => $request->source ?? $lead->source ?? 'whatsapp',
                'conversation_stage'  => $request->conversation_stage ?? $lead->conversation_stage,
                'last_interaction_at' => now(),
            ]);

            $lead->save();

            return response()->json([
                'status'  => 'success',
                'message' => 'Data Lead berhasil diproses',
                'data'    => $lead
            ], 200);

        } catch (\Exception $e) {
            Log::error('Lead Ingest Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Ingest Chat Log from n8n
     * Endpoint: POST /api/webhook/chats
     */
    public function ingestChat(Request $request)
    {
        $request->validate([
            'persona_id' => 'required|exists:personas,id',
            'phone'      => 'required|string', // Kita cari lead_id dari phone
            'message'    => 'required|string',
            'from_type'  => 'required|in:user,bot',
        ]);

        try {
            // Cari Lead dulu
            $lead = Lead::where('persona_id', $request->persona_id)
                        ->where('phone', $request->phone)
                        ->first();

            // Simpan Chat Log
            $chat = ChatLog::create([
                'persona_id' => $request->persona_id,
                'lead_id'    => $lead ? $lead->id : null, // Bisa null jika lead belum terdaftar (jarang terjadi)
                'from_type'  => $request->from_type,
                'message'    => $request->message,
                'context_snapshot' => $request->context_snapshot ?? null,
                'created_at' => now(),
            ]);

            // Update last_interaction di Lead jika ada
            if ($lead) {
                $lead->update(['last_interaction_at' => now()]);
            }

            return response()->json(['status' => 'success', 'data' => $chat], 201);

        } catch (\Exception $e) {
            Log::error('Chat Ingest Error: ' . $e->getMessage());
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Ingest Decision/Summary from n8n
     * Endpoint: POST /api/webhook/decisions
     */
    public function ingestDecision(Request $request)
    {
        $request->validate([
            'persona_id'      => 'required|exists:personas,id',
            'phone'           => 'required|string',
            'summary'         => 'required|string',
            'estimated_value' => 'nullable|in:low,medium,high,unknown',
            'status'          => 'nullable|in:needs_review,interested,ignore',
        ]);

        try {
            $lead = Lead::where('persona_id', $request->persona_id)
                        ->where('phone', $request->phone)
                        ->firstOrFail();

            $decision = DecisionInbox::create([
                'persona_id'       => $request->persona_id,
                'lead_id'          => $lead->id,
                'detected_intent'  => $request->detected_intent,
                'brand_name'       => $request->brand_name,
                'cooperation_type' => $request->cooperation_type,
                'summary'          => $request->summary,
                'estimated_value'  => $request->estimated_value ?? 'unknown',
                'status'           => $request->status ?? 'needs_review',
            ]);

            return response()->json([
                'status' => 'success',
                'data'   => $decision
            ], 201);

        } catch (\Exception $e) { 
            Log::error('Decision Ingest Error', [
                'message' => $e->getMessage(),
                'payload' => $request->all()
            ]);

            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to ingest decision'
            ], 500);
        }
    }

}
