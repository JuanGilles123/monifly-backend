<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the user dashboard.
     */
    public function index(Request $request): View
    {
        $user = $request->user();
        
        // Get user's financial goals
        $goals = $user->goals()->latest()->get();
        
        // Calculate some basic stats
        $totalGoals = $goals->count();
        $completedGoals = $goals->where('is_completed', true)->count();
        $totalTargetAmount = $goals->sum('target_amount');
        $totalProgressAmount = $goals->sum('progress_amount');
        
        return view('dashboard', compact(
            'user',
            'goals',
            'totalGoals',
            'completedGoals',
            'totalTargetAmount',
            'totalProgressAmount'
        ));
    }
}
