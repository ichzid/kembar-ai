<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class ChatLogController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        $leads = Lead::whereHas('persona', function ($query) {
                $query->where('user_id', Auth::id());
            })
            ->with(['persona'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                      ->orWhere('phone', 'like', "%{$search}%")
                      ->orWhereHas('persona', function ($q2) use ($search) {
                          $q2->where('persona_name', 'like', "%{$search}%");
                      });
                });
            })
            ->orderByDesc('last_interaction_at')
            ->paginate(10);

        // Manually load recent chat logs to avoid N+1 issue with limit
        foreach ($leads as $lead) {
            $lead->recent_logs = $lead->chatLogs()->latest()->take(2)->get()->reverse();
        }

        return view('chat-logs.index', compact('leads', 'search'));
    }

    public function show(Request $request, Lead $lead)
    {
        if ($lead->persona->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $logs = $lead->chatLogs()->orderBy('created_at', 'asc')->get();

        return view('chat-logs.show', compact('lead', 'logs'));
    }
}
