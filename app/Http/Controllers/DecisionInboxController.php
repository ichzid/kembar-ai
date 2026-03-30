<?php

namespace App\Http\Controllers;

use App\Models\DecisionInbox;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
 
class DecisionInboxController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'needs_review');

        // Fetch decisions for the user's personas
        $decisions = DecisionInbox::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['lead', 'persona'])
        ->when($status !== 'all', function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->latest()
        ->paginate(10)
        ->appends(['status' => $status]);

        return view('decision-inbox.index', compact('decisions', 'status'));
    }

    public function update(Request $request, DecisionInbox $decision)
    {
        if (!$request->user()->leads_enabled) {
            abort(403);
        }

        // Ensure the decision belongs to a persona owned by the authenticated user
        if ($decision->persona->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:interested,ignore,needs_review,review_later',
        ]);

        $decision->update([
            'status' => $validated['status'],
            'action_taken_at' => now(),
        ]);

        if ($validated['status'] === 'interested' && $request->input('contact_method') === 'ai') {
            $decision->load('lead');

            $webhookUrl = config('services.n8n.webhook_url');

            if ($webhookUrl) {
                Http::post($webhookUrl, [
                    'decision' => $decision->toArray(),
                    'lead' => $decision->lead ? $decision->lead->toArray() : null,
                ]);
            }
        }

        return back()->with('success', 'Status keputusan berhasil diperbarui.');
    }

    public function export(Request $request)
    {
        if (!$request->user()->leads_enabled) {
            abort(403);
        }

        $status = $request->get('status', 'needs_review');
        $filename = 'decision-inbox-' . date('Y-m-d') . '.csv';

        $decisions = DecisionInbox::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->with(['lead', 'persona'])
        ->when($status !== 'all', function ($query) use ($status) {
            return $query->where('status', $status);
        })
        ->latest()
        ->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($decisions) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Row
            fputcsv($file, [
                'ID', 
                'Persona', 
                'Lead Name', 
                'Lead Phone', 
                'Intent', 
                'Brand Name', 
                'Cooperation Type', 
                'Estimated Value', 
                'Summary', 
                'Status', 
                'Created At'
            ]);

            foreach ($decisions as $decision) {
                fputcsv($file, [
                    $decision->id,
                    $decision->persona->persona_name ?? '-',
                    $decision->lead->name ?? '-',
                    $decision->lead->phone ?? '-',
                    $decision->detected_intent,
                    $decision->brand_name,
                    $decision->cooperation_type,
                    $decision->estimated_value,
                    $decision->summary,
                    $decision->status,
                    $decision->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
