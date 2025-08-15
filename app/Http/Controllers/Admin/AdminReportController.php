<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\IncidentReport;
use Illuminate\Http\Request;

class AdminReportController extends Controller
{
    public function index(Request $r)
    {
        $q = IncidentReport::with('user');
        if ($r->filled('start_date') && $r->filled('end_date'))
            $q->whereBetween('occurred_at', [$r->start_date, $r->end_date]);
        if ($r->filled('location')) $q->where('location','like',"%{$r->location}%");
        if ($r->filled('status'))   $q->where('status',$r->status);
        if ($r->boolean('flagged')) $q->where('flagged',1);
        if ($r->boolean('anonymous'))
            $q->where(fn($w)=>$w->where('is_anonymous',1)->orWhereNull('user_id'));

        $reports = $q->latest()->paginate(20);
        return view('admin.reports.index', compact('reports'));
    }

    public function show(IncidentReport $report)
    {   return view('admin.reports.show', compact('report')); }

    public function toggleFlag(IncidentReport $report)
    {   $report->update(['flagged'=>!$report->flagged]); return back()->with('success','Flag updated'); }

    public function updateStatus(Request $r, IncidentReport $report)
    {
        $r->validate(['status'=>'required|in:open,under_review,resolved']);
        $report->update(['status'=>$r->status]);
        return back()->with('success','Status updated');
    }

    public function destroy(IncidentReport $report)
    {   $report->delete(); return back()->with('success','Report deleted'); }
}