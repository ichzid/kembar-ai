<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\User;
use App\Models\WhatsappAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QiscusIntegrationController extends Controller 
{
    /**
     * Resolve Persona and Lead based on Qiscus App Code and Sender Number
     * Endpoint: POST /api/integrations/qiscus/resolve
     */
    public function resolve(Request $request)
    {
        // Support payload variasi dari Qiscus/n8n
        // Kadang nomor pengirim ada di 'email' (Qiscus native) atau 'sender_number' (n8n transform)
        $senderNumber = $request->input('sender_number') ?? $request->input('email');
        
        // Merge kembali ke request agar validasi berjalan lancar
        $request->merge(['sender_number' => $senderNumber]);

        $request->validate([
            'app_code' => 'nullable|string',
            'bot_phone' => 'nullable|string', 
            'sender_number' => 'required|string', // Ini sekarang akan mengambil dari email jika null
            'name' => 'nullable|string',
        ]);

        $senderNumber = $request->sender_number;

        // 1. Find WhatsappAccount (Bot)
        // Support lookup by App Code OR Bot Phone (or both)
        $query = WhatsappAccount::where('provider', 'qiscus');

        if ($request->app_code) {
            $query->where('provider_app_id', $request->app_code);
        }

        if ($request->bot_phone) {
            // Clean phone number if needed, assuming exact match for now or handled by caller
            $query->where('phone_number', $request->bot_phone);
        }

        $account = $query->with(['persona.settings', 'persona.knowledge'])->first();

        // If not found, log warning and return error
        if (!$account || !$account->persona) {
            Log::warning("Qiscus Integration: Account not found. Params: " . json_encode($request->all()));
            return response()->json([
                'status' => 'error',
                'message' => 'Integration not found for provided credentials'
            ], 404);
        }

        $persona = $account->persona;

        // 2. Find or Create Lead (User)
        $lead = Lead::firstOrNew([
            'persona_id' => $persona->id,
            'phone' => $senderNumber,
        ]);

        $isNewLead = !$lead->exists;

        if ($isNewLead) {
            $lead->source = 'whatsapp'; // Standardize on whatsapp, distinguish in details
            $lead->name = $request->name ?? 'Unknown';
            $lead->conversation_stage = 'new';
            $lead->details = [
                'provider' => 'qiscus',
                'provider_app_id' => $request->app_code,
                'bot_phone' => $request->bot_phone
            ];
            $lead->save();
        } else {
            // Update name if provided and currently empty or placeholder
            if ($request->name && ($lead->name === 'Unknown' || empty($lead->name))) {
                $lead->name = $request->name;
                $lead->save();
            }
        }

        // 3. Get Recent Chat History (for AI Context)
        $recentChats = $lead->chatLogs()
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get()
            ->map(function ($chat) {
                return [
                    'role' => $chat->from_type === 'user' ? 'user' : 'assistant',
                    'content' => $chat->message,
                    'created_at' => $chat->created_at->toIso8601String(),
                ];
            })
            ->reverse()
            ->values();

        // 4. Return Combined Data
        return response()->json([
            'status' => 'success',
            'data' => [
                'account' => [
                    'provider_app_id' => $account->provider_app_id,
                    'provider_secret_key' => $account->provider_secret_key,
                    'phone_number' => $account->phone_number,
                ],
                'persona' => [
                    'id' => $persona->id,
                    'name' => $persona->persona_name,
                    'instructions' => $persona->persona_description . "\n" . $persona->role_summary, // Combine for n8n
                    'settings' => $persona->settings,
                    'knowledge' => $persona->knowledge,
                ],
                'lead' => [
                    'id' => $lead->id,
                    'name' => $lead->name,
                    'is_new' => $isNewLead,
                    'phone' => $lead->phone
                    // 'phone' => $lead->phone,
                    // 'recent_chats' => $recentChats
                ]
            ]
        ]);
    }

    public function flags(Request $request)
    {
        $senderNumber = $request->input('sender_number') ?? $request->input('email');
        $request->merge(['sender_number' => $senderNumber]);

        $request->validate([
            'app_code' => 'nullable|string',
            'bot_phone' => 'nullable|string',
            'sender_number' => 'required|string',
        ]);

        $senderNumber = $request->sender_number;

        $isAdmin = false;
        $isNewLead = false;
        $isLeadsCrmOn = false;
        $isContextualCtaOn = false;

        $query = WhatsappAccount::where('provider', 'qiscus');

        if ($request->app_code) {
            $query->where('provider_app_id', $request->app_code);
        }

        if ($request->bot_phone) {
            $query->where('phone_number', $request->bot_phone);
        }

        $account = $query->with(['persona.user'])->first();

        if ($account && $account->persona && $account->persona->user) {
            $persona = $account->persona;
            $user = $persona->user;

            $isAdmin = $user->admin_whatsapp_number === $senderNumber;
            $isLeadsCrmOn = (bool) $user->leads_enabled;
            $isContextualCtaOn = (bool) $user->contextual_cta_enabled;

            $leadExists = Lead::where('persona_id', $persona->id)
                ->where('phone', $senderNumber)
                ->exists();

            $isNewLead = !$leadExists;
        }

        return response()->json([
            'is_admin' => $isAdmin,
            'is_new_lead' => $isNewLead,
            'is_leads_crm_on' => $isLeadsCrmOn,
            'is_contextual_cta_on' => $isContextualCtaOn,
        ]);
    }
}
