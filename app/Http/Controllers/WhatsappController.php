<?php

namespace App\Http\Controllers;

use App\Models\WhatsappAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WhatsappController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        $persona = $user->personas()->first();
        $whatsappAccount = null;

        if ($persona) {
            $whatsappAccount = $persona->whatsappAccount;
        }

        return view('whatsapp.index', compact('whatsappAccount', 'persona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|max:20|unique:whatsapp_accounts,phone_number',
            'provider' => 'required|string|in:baileys,meta,twilio,qiscus',
            'provider_app_id' => 'nullable|required_if:provider,qiscus|string',
            'provider_secret_key' => 'nullable|string',
        ]);

        $user = Auth::user();
        $persona = $user->personas()->first();

        if (!$persona) {
            return redirect()->route('whatsapp.index')->with('error', 'Anda harus membuat Persona terlebih dahulu sebelum menghubungkan WhatsApp.');
        }

        if ($persona->whatsappAccount) {
            return redirect()->route('whatsapp.index')->with('error', 'Persona ini sudah terhubung dengan akun WhatsApp.');
        }

        WhatsappAccount::create([
            'user_id' => $user->id,
            'persona_id' => $persona->id,
            'phone_number' => $request->phone_number,
            'provider' => $request->provider,
            'provider_app_id' => $request->provider_app_id,
            'provider_secret_key' => $request->provider_secret_key,
            'status' => 'connected', // Simulasikan langsung terkoneksi untuk MVP
            'last_connected_at' => now(),
        ]);

        return redirect()->route('whatsapp.index')->with('success', 'WhatsApp berhasil dihubungkan.');
    }

    public function destroy(WhatsappAccount $whatsappAccount)
    {
        if ($whatsappAccount->user_id !== Auth::id()) {
            abort(403, 'Tindakan tidak diizinkan.');
        }

        $whatsappAccount->delete();

        return redirect()->route('whatsapp.index')->with('success', 'Koneksi WhatsApp berhasil diputuskan.');
    }
}
