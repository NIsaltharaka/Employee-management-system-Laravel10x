@extends('layout.index')
@section('title', 'chart')
@section('nav')
@section('header')
@section('content')

<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">BAR Chart</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body p-5">
                            <canvas id="departmentPositionChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="row d-flex justify-content-center align-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-uppercase">PIE Chart</h4>
                    <hr>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <div class="card-body p-5">
                            <canvas id="departmentPieChart" width="400" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
<script>
    var chartData = @json($data);

    var departments = [...new Set(chartData.map(item => item.department))];
    var positions = [...new Set(chartData.map(item => item.position))];

    var countsMatrix = Array.from({ length: departments.length }, () =>
    Array.from({ length: positions.length }, () => 0));

                chartData.forEach(item => {
                    var departmentIndex = departments.indexOf(item.department);
                    var positionIndex = positions.indexOf(item.position);
                    countsMatrix[departmentIndex][positionIndex] = item.count;
                });

                // Bar Chart
                var ctxBar = document.getElementById('departmentPositionChart').getContext('2d');
                var barChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: positions,
                        datasets: departments.map((department, departmentIndex) => ({
                            label: department,
                            data: countsMatrix[departmentIndex],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 1
                        }))
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Pie Chart
                var ctxPie = document.getElementById('departmentPieChart').getContext('2d');
                var pieChart = new Chart(ctxPie, {
                    type: 'pie',
                    data: {
                        labels: departments,
                        datasets: [{
                            data: departments.map((department, departmentIndex) => countsMatrix[departmentIndex].reduce((sum, count) => sum + count, 0)),
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                            ],
                            borderWidth: 1
        }]
    }
});                
</script>
@endsection