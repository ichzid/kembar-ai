<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');
        $leads = Lead::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        })
        ->latest('last_interaction_at')->paginate((int) $perPage)->withQueryString();

        return view('leads.index', compact('leads'));
    }

    public function export(Request $request)
    {
        if (!$request->user()->leads_enabled) {
            abort(403);
        }

        $filename = 'leads-' . date('Y-m-d') . '.csv';
        
        $search = $request->query('search');
        $leads = Lead::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })
        ->when($search, function ($query, $search) {
            return $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('address', 'like', "%{$search}%");
            });
        })
        ->latest('last_interaction_at')->get();

        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $callback = function() use ($leads) {
            $file = fopen('php://output', 'w');
            
            // Add BOM for Excel compatibility
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            // Header Row
            fputcsv($file, [
                'ID', 
                'Persona', 
                'Name', 
                'Phone', 
                'Email', 
                'Address', 
                'Interest', 
                'Source', 
                'Stage', 
                'Last Interaction', 
                'Created At'
            ]);

            foreach ($leads as $lead) {
                fputcsv($file, [
                    $lead->id,
                    $lead->persona->persona_name ?? '-',
                    $lead->name,
                    $lead->phone,
                    $lead->email,
                    $lead->address,
                    $lead->interest,
                    $lead->source,
                    $lead->conversation_stage,
                    $lead->last_interaction_at,
                    $lead->created_at,
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
