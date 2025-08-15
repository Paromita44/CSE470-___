<!-- @extends('admin.layouts.admin')

@section('content')
    <div class="container mt-4">
        <h1>Admin Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">New Reports Today</h5>
                        <p class="card-text">{{ $newReportsToday }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Open Reports</h5>
                        <p class="card-text">{{ $openReports }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Flagged Reports</h5>
                        <p class="card-text">{{ $flaggedReports }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Anonymous Reports</h5>
                        <p class="card-text">{{ $anonymousReportsPercentage }}%</p>
                    </div>
                </div>
            </div>
        </div>

        <h2 class="mt-5">Reports by Day (Last 7 Days)</h2>
        <div id="reportsByDayChart"></div>

        <h2 class="mt-5">Reports by Location (Last 30 Days)</h2>
        <div id="reportsByLocationChart"></div>

        <h2 class="mt-5">Recent Reports</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($recentReports as $report)
                    <tr>
                        <td>{{ $report->id }}</td>
                        <td>{{ $report->created_at->format('m/d/Y') }}</td>
                        <td>{{ $report->location }}</td>
                        <td>{{ ucfirst($report->status) }}</td>
                        <td>
                            <a href="{{ route('admin.reports.show', $report) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.reports.status', $report) }}" class="btn btn-success btn-sm">Resolve</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection -->