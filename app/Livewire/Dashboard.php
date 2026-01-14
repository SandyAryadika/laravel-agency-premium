<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Invoice;
use App\Models\Client;
use App\Models\ActivityLog;
use App\Models\Expense; // <--- JANGAN LUPA IMPORT INI
use Carbon\Carbon;

class Dashboard extends Component
{
    public function mount()
    {
        if (!Auth::check()) {
            return $this->redirect('/');
        }
    }

    public function render()
    {
        $user = Auth::user();

        // Safety Check
        if (!$user) {
            return view('livewire.dashboard', [
                'activeProjects' => 0,
                'totalRevenue' => 0,
                'totalExpenses' => 0,
                'netProfit' => 0,
                'profitMargin' => 0,
                'totalClients' => 0,
                'chartMonths' => [],
                'chartRevenues' => [],
                'chartExpenses' => [], // Data Baru untuk Grafik
                'projectLabels' => [],
                'projectCounts' => [],
                'recentActivities' => []
            ]);
        }

        // --- 1. DATA UTAMA ---

        // Active Projects
        $activeProjects = Project::where('user_id', $user->id)
            ->where('status', 'in_progress')
            ->count();

        // Total Revenue (Invoices Paid)
        $totalRevenue = Invoice::whereHas('project', function ($q) use ($user) {
            $q->where('user_id', $user->id);
        })
            ->where('status', 'paid')
            ->sum('amount');

        // Total Expenses (BARU)
        $totalExpenses = Expense::where('user_id', $user->id)->sum('amount');

        // Net Profit (BARU)
        $netProfit = $totalRevenue - $totalExpenses;

        // Profit Margin % (BARU)
        $profitMargin = $totalRevenue > 0 ? ($netProfit / $totalRevenue) * 100 : 0;

        // Total Clients
        $totalClients = Client::count();

        // Activity Logs
        $recentActivities = ActivityLog::where('user_id', $user->id)
            ->with('user')
            ->latest()
            ->take(5)
            ->get();


        // --- 2. CHART DATA (Revenue vs Expenses) ---
        $months = [];
        $revenues = [];
        $expensesChart = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $months[] = $date->format('M Y');

            // Revenue per Bulan
            $monthlyRev = Invoice::whereHas('project', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            })
                ->where('status', 'paid')
                ->whereYear('issue_date', $date->year)
                ->whereMonth('issue_date', $date->month)
                ->sum('amount');

            // Expense per Bulan
            $monthlyExp = Expense::where('user_id', $user->id)
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $revenues[] = $monthlyRev;
            $expensesChart[] = $monthlyExp;
        }

        // --- 3. PROJECT STATUS CHART ---
        $projectStats = Project::where('user_id', $user->id)
            ->selectRaw('status, count(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        // Normalisasi keys agar rapi di chart (Pending, In Progress, Completed)
        $cleanStats = [
            'Pending' => $projectStats['pending'] ?? 0,
            'In Progress' => $projectStats['in_progress'] ?? 0,
            'Completed' => $projectStats['completed'] ?? 0,
        ];

        return view('livewire.dashboard', [
            'activeProjects'   => $activeProjects,
            'totalRevenue'     => $totalRevenue,
            'totalExpenses'    => $totalExpenses, // Kirim ke View
            'netProfit'        => $netProfit,     // Kirim ke View
            'profitMargin'     => $profitMargin,  // Kirim ke View
            'totalClients'     => $totalClients,
            'chartMonths'      => $months,
            'chartRevenues'    => $revenues,
            'chartExpenses'    => $expensesChart, // Kirim ke View
            'projectLabels'    => array_keys($cleanStats),
            'projectCounts'    => array_values($cleanStats),
            'recentActivities' => $recentActivities,
        ]);
    }
}
