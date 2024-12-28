@extends('admin.layout.main')
@section('manage_content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="content-body">
    <div class="container-fluid">
        <!-- Row: Total Trip Section -->
        <div class="row mb-4 mt-4">
            <!-- Total Users -->
            <div class="col-lg-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <a href="{{route('user.index')}}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">{{ number_format($Userscount) }}</h4>
                                <h6>Users</h6>
                            </div>
                            <i class="mdi mdi-account-multiple display-4 text-primary"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Total Drivers -->
            <div class="col-lg-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <a href="{{route('all_drivers.index')}}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">{{ number_format($Drivercount) }}</h4>
                                <h6>Drivers</h6>
                            </div>
                            <i class="mdi mdi-car display-4 text-danger"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Total Earnings -->
            <div class="col-lg-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">₹ 0</h4>
                                <h6>Total Earnings</h6>
                            </div>
                            <i class="mdi mdi-wallet display-4 text-warning"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Admin Commission -->
            <div class="col-lg-3">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">₹ 0</h4>
                                <h6>Admin Commission</h6>
                            </div>
                            <i class="mdi mdi-cash display-4 text-success"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row: Trip Statistics -->
        <div class="row mb-4">
            <!-- Completed Trip -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-primary text-white rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4>0</h4>
                                <h6>Completed Trip</h6>
                            </div>
                            <i class="mdi mdi-calendar-check display-4"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Confirmed Trip -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">0</h4>
                                <h6>Confirmed Trip</h6>
                            </div>
                            <i class="mdi mdi-car display-4 text-danger"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Cancelled Trip -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-danger text-white rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4>0</h4>
                                <h6>Cancelled Trip</h6>
                            </div>
                            <i class="mdi mdi-close display-4"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row: Today's Trip Statistics -->
        <div class="row mb-4">
            <!-- New Users Today -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <a href="{{route('user.index')}}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">{{number_format($newUsers->count())}}</h4>
                                <h6>New Users</h6>
                            </div>
                            <i class="mdi mdi-account-multiple-plus display-4 text-primary"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- New Drivers Today -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <a href="{{route('all_drivers.index')}}">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">{{number_format($newDriver->count())}}</h4>
                                <h6>New Drivers</h6>
                            </div>
                            <i class="mdi mdi-car display-4 text-danger"></i>
                        </div>
                    </a>
                </div>
            </div>

            <!-- Earnings Today -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-light rounded">
                    <a href="#">
                        <div class="card-body d-flex align-items-center justify-content-between">
                            <div>
                                <h4 class="text-dark">₹ 0.00</h4>
                                <h6>Total Earnings</h6>
                            </div>
                            <i class="mdi mdi-cash-multiple display-4 text-warning"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Row: Charts Section -->
        <div class="row mb-4">
            <!-- Total Sales Chart -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <h5>Total Sales</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="sales-chart" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Service Overview Chart -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <h5>Service Overview</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="service-overview" height="200"></canvas>
                    </div>
                </div>
            </div>

            <!-- Sales Overview Chart -->
            <div class="col-lg-4">
                <div class="card shadow-lg p-3 mb-5 bg-white rounded">
                    <div class="card-header">
                        <h5>Sales Overview</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="sales-overview" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-mQ93gk4fAa5q2SM9Klyz0QZfZZ8tY8hvHdU7F3y0p8lWQ4G21B0z1yboM+77aumB" crossorigin="anonymous"></script>
<script>
    var ctxSales = document.getElementById('sales-chart').getContext('2d');
    var salesChart = new Chart(ctxSales, {
        type: 'bar',
        data: {
            labels: ['January', 'February', 'March', 'April', 'May', 'June'],
            datasets: [{
                label: 'Total Sales',
                data: [12000, 15000, 11000, 19000, 21000, 17000],
                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    var ctxService = document.getElementById('service-overview').getContext('2d');
    var serviceChart = new Chart(ctxService, {
        type: 'doughnut',
        data: {
            labels: ['Service A', 'Service B', 'Service C'],
            datasets: [{
                label: 'Service Overview',
                data: [300, 50, 100],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    var ctxSalesOverview = document.getElementById('sales-overview').getContext('2d');
    var salesOverviewChart = new Chart(ctxSalesOverview, {
        type: 'pie',
        data: {
            labels: ['Product A', 'Product B', 'Product C'],
            datasets: [{
                label: 'Sales Overview',
                data: [5000, 3000, 2000],
                backgroundColor: [
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 205, 86, 0.6)'
                ],
                borderColor: [
                    'rgba(255, 159, 64, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 205, 86, 1)'
                ],
                borderWidth: 1
            }]
        }
    });

    public

    function index() {
        $salesData = [12000, 15000, 11000, 19000, 21000, 17000];
        $serviceData = [300, 50, 100];
        $salesOverviewData = [5000, 3000, 2000];

        return view('dashboard', compact('salesData', 'serviceData', 'salesOverviewData'));
    }
</script>
@endsection