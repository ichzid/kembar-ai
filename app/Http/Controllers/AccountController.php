<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function index()
    {
        return view('account.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'contextual_cta_text' => 'nullable|string|max:1000',
            'admin_whatsapp_number' => 'nullable|string|max:30',
        ]);

        $user = $request->user();

        $user->leads_enabled = $request->boolean('leads_enabled');
        $user->contextual_cta_enabled = $request->boolean('contextual_cta_enabled');
        $user->contextual_cta_text = $user->contextual_cta_enabled ? $request->input('contextual_cta_text') : null;
        $user->admin_whatsapp_number = $request->input('admin_whatsapp_number');
        $user->save();

        return redirect()
            ->route('account.index')
            ->with('success', 'Pengaturan akun berhasil disimpan.');
    }
}
