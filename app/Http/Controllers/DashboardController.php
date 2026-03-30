<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Persona;
use App\Models\Lead;
use App\Models\ChatLog;
use App\Models\DecisionInbox;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Real Data
        $totalPersonas = Persona::where('user_id', $user->id)->count();
        $totalLeads = Lead::whereHas('persona', function($q) use ($user) {
            $q->where('user_id', $user->id);
        })->count();
        $recentPersonas = Persona::where('user_id', $user->id)
            ->latest('updated_at')
            ->take(5)
            ->get();

        // Real Data for Chat Logs and Decision Inbox
        $todayChats = ChatLog::whereHas('persona', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->whereDate('created_at', Carbon::today())->count();

        $pendingDecisions = DecisionInbox::whereHas('persona', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->where('status', 'needs_review')->count();

        // MERGED ACTIVITY FEED (Chats, Leads, Decisions)
        // 1. New Chats
        $recentChats = ChatLog::whereHas('persona', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->where('from_type', 'user')
            ->with(['persona', 'lead'])
            ->latest()
            ->take(10)
            ->get()
            ->map(function ($item) {
                $item->activity_type = 'chat_log';
                return $item;
            });

        // 2. New Leads
        $recentNewLeads = Lead::whereHas('persona', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['persona'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->activity_type = 'new_lead';
                return $item;
            });

        // 3. Decisions Needed
        $recentDecisions = DecisionInbox::whereHas('persona', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
            ->with(['persona', 'lead'])
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($item) {
                $item->activity_type = 'decision';
                return $item;
            });

        // Merge and Sort
        $recentActivities = $recentChats->merge($recentNewLeads)
            ->merge($recentDecisions)
            ->sortByDesc('created_at')
            ->take(5);

        return view('dashboard.index', compact(
            'user', 
            'totalPersonas', 
            'totalLeads', 
            'recentPersonas',
            'todayChats',
            'pendingDecisions',
            'recentActivities'
        ));
    }
}
