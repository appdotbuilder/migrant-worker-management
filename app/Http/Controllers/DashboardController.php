<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\TrainingProgram;
use App\Models\FinancialTransaction;
use App\Models\MemberTraining;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index()
    {
        $stats = [
            'total_members' => Member::count(),
            'active_members' => Member::where('status', 'active')->count(),
            'training_members' => Member::where('status', 'training')->count(),
            'deployed_members' => Member::where('status', 'deployed')->count(),
            'total_programs' => TrainingProgram::count(),
            'active_programs' => TrainingProgram::where('status', 'active')->count(),
            'ongoing_trainings' => MemberTraining::where('status', 'ongoing')->count(),
            'completed_trainings' => MemberTraining::where('status', 'completed')->count(),
            'total_income' => FinancialTransaction::where('type', 'income')->sum('amount'),
            'total_expense' => FinancialTransaction::where('type', 'expense')->sum('amount'),
        ];

        $stats['balance'] = $stats['total_income'] - $stats['total_expense'];

        // Recent activities
        $recentMembers = Member::latest()->take(5)->get();
        $recentTransactions = FinancialTransaction::with('member')
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recentMembers' => $recentMembers,
            'recentTransactions' => $recentTransactions,
        ]);
    }
}