<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\IncidentReport;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Fetch statistics for the admin dashboard
        $newReportsToday = IncidentReport::whereDate('created_at', today())->count();
        $openReports = IncidentReport::where('status', 'open')->count();
        $flaggedReports = IncidentReport::where('flagged', true)->count();
        $totalReports = IncidentReport::count();
        $anonymousReports = IncidentReport::where('is_anonymous', true)->count();
        $anonymousReportsPercentage = $totalReports > 0 ? ($anonymousReports / $totalReports) * 100 : 0;

        // Fetch reports by day (last 7 days)
        $reportsByDayData = IncidentReport::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->whereDate('created_at', '>=', now()->subDays(7))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date', 'asc')
            ->pluck('count', 'date');

        // Fetch reports by location (last 30 days)
        $locations = IncidentReport::pluck('location')->unique();
        $reportsByLocationData = $locations->map(function ($location) {
            return IncidentReport::where('location', $location)->count();
        });

        // Fetch recent reports
        $recentReports = IncidentReport::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'newReportsToday', 'openReports', 'flaggedReports', 'anonymousReportsPercentage', 
            'reportsByDayData', 'reportsByLocationData', 'locations', 'recentReports'
        ));
    }
}