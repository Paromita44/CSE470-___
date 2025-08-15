<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <style>
        body, html {
            height: 100%;
            margin: 0;
        }
        .container-fluid {
            height: 100%;
            display: flex;
            flex-direction: row;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            position: fixed;
        }
        .sidebar h3 {
            color: white;
            text-align: center;
        }
        .sidebar a {
            color: white;
            padding: 10px;
            font-size: 18px;
            text-decoration: none;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            width: 100%;
            display: flex;
            flex-direction: column;
            height: 100%;
        }
        /* Horizontal Layout for Cards */
        .row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }
        .card {
            width: 22%;
            margin-bottom: 20px;
            box-sizing: border-box;
        }
        .card-header {
            font-size: 18px;
            font-weight: bold;
        }
        .card-body {
            font-size: 16px;
        }
        .graph-section {
            width: 48%;
            margin-bottom: 20px;
            margin-right: 20px;
        }
        .table-container {
            width: 100%;
            margin-top: 20px;
        }
        .table {
            width: 100%;
            table-layout: fixed;
        }
        .nav-item {
            margin-bottom: 10px;
        }
        .card-body h5 {
            font-size: 24px;
        }

        /* Logout Button Styling */
        .logout-btn {
            background-color: #f44336; /* Red background */
            color: white; /* White text color */
            font-size: 18px; /* Larger text */
            padding: 12px 24px; /* Padding for the button */
            border-radius: 5px; /* Rounded corners */
            border: none; /* Remove border */
            width: 100%; /* Full width */
            cursor: pointer; /* Pointer cursor */
            text-align: center; /* Center text */
            margin-top: 20px; /* Spacing from content */
        }

        .logout-btn:hover {
            background-color: #d32f2f; /* Darker red when hovered */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <!-- Sidebar -->
        <div class="col-md-2 sidebar">
            <h3>Admin Panel</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.reports.index') }}">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index') }}">Users</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.directory.index') }}">Directory</a>
                </li>
            </ul>

            <!-- Logout Form -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">Logout</button> <!-- Styled logout button -->
            </form>
        </div>

        <!-- Main Content -->
        <div class="col-md-10 main-content">
            <!-- Dashboard Summary Cards (Horizontal Layout) -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">New Reports Today</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Open Reports</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Flagged</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header">Anonymous</div>
                        <div class="card-body">
                            <h5 class="card-title"></h5>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Graphs Section -->
            <div class="row">
                <div class="graph-section">
                    <h3>Reports by Day (Last 7 Days)</h3>
                    <canvas id="reportsDayChart"></canvas>
                </div>
                <div class="graph-section">
                    <h3>Reports by Location (Last 30 Days)</h3>
                    <canvas id="reportsLocationChart"></canvas>
                </div>
            </div>

            <!-- Recent Reports Table -->
            <div class="table-container">
                <h3>Recent Reports</h3>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Reporter</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>10</td>
                            <td>08/23</td>
                            <td>Anacimita</td>
                            <td>Anonymous</td>
                            <td>Open</td>
                            <td><button class="btn btn-info">View</button> <button class="btn btn-success">Resolve</button></td>
                        </tr>
                        <tr>
                            <td>11</td>
                            <td>08/23</td>
                            <td>Aranipau</td>
                            <td>Under Review</td>
                            <td>Under Review</td>
                            <td><button class="btn btn-info">View</button> <button class="btn btn-success">Resolve</button></td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>08/23</td>
                            <td>Aromita</td>
                            <td>Resolved</td>
                            <td>Resolved</td>
                            <td><button class="btn btn-info">View</button> <button class="btn btn-success">Resolve</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>

    <!-- Chart.js -->
    <script>
        // Reports by Day Chart
        const ctx1 = document.getElementById('reportsDayChart').getContext('2d');
        const reportsDayChart = new Chart(ctx1, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Reports by Day',
                    data: [10, 12, 5, 8, 15, 18],
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1,
                    fill: false
                }]
            }
        });

        // Reports by Location Chart
        const ctx2 = document.getElementById('reportsLocationChart').getContext('2d');
        const reportsLocationChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: ['Sep', 'Oct', 'Jan', 'Jul', 'Aug'],
                datasets: [{
                    label: 'Reports by Location',
                    data: [15, 20, 25, 10, 5],
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            }
        });
    </script>
</body>
</html>