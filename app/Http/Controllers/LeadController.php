<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lead;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $leads = Lead::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest('last_interaction_at')->paginate(10);

        return view('leads.index', compact('leads'));
    }

    public function export(Request $request)
    {
        if (!$request->user()->leads_enabled) {
            abort(403);
        }

        $filename = 'leads-' . date('Y-m-d') . '.csv';
        
        $leads = Lead::whereHas('persona', function ($query) {
            $query->where('user_id', Auth::id());
        })->latest('last_interaction_at')->get();

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
