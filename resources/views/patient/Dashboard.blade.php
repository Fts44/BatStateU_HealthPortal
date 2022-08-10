@extends('layout.patient-main')

@push('title')
    <title>Patient Dashboard</title>
@endpush


@section('content')

    <div id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb" style="--bs-breadcrumb-divider: '|';">
                    <!-- <li class="breadcrumb-item">All</li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Product Info</li> -->
                </ol>
            </nav>
        </div>
        
        <div class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Infirmary Visit Frequency</h5>
                            <!-- Line Chart -->
                            <canvas id="lineChart" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#lineChart'), {
                                    type: 'line',
                                    data: {
                                    labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Nov', 'Dec'],
                                    datasets: [{
                                        label: 'Line Chart',
                                        data: [0, 0, 1, 0, 0, 0, 0, 2, 1, 0, 0, 1],
                                        fill: false,
                                        borderColor: 'rgb(75, 192, 192)',
                                        tension: 0.1
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
                                });
                            </script>
                        <!-- End Line CHart -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Body Mass Index</h5>
                            <!-- Line Chart -->
                            <canvas id="test" style="max-height: 400px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                    new Chart(document.querySelector('#test'), {
                                        type: 'line',
                                        data: {
                                        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                                        datasets: [
                                            {
                                                label: 'Result',
                                                data: [18, 18, 20, 22, 23, 24.5, 23, 15, 18, 20, 22, 23, 24, 24],
                                                fill: false,
                                                borderColor: '#adb5bd',
                                                tension: 0.1
                                            }
                                            ]
                                        },
                                        options: {
                                            scales: {
                                                y: {
                                                    beginAtZero: false
                                                }
                                            }
                                        }
                                    });
                                });
                            </script>
                        <!-- End Line CHart -->
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Purpose of Visit</h5>

                            <!-- Doughnut Chart -->
                            <canvas id="doughnutChart" style="max-height: 224px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#doughnutChart'), {
                                    type: 'doughnut',
                                    data: {
                                    labels: [
                                        'Consultation',
                                        'Medication',
                                        'Submit Documents'
                                    ],
                                    datasets: [{
                                        label: 'My First Dataset',
                                        data: [300, 50, 100],
                                        backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)',
                                        'rgb(255, 205, 86)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                    }
                                });
                                });
                            </script>
                            <!-- End Doughnut CHart -->

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Medication Received</h5>

                            <!-- Doughnut Chart -->
                            <canvas id="testt" style="max-height: 224px;"></canvas>
                            <script>
                                document.addEventListener("DOMContentLoaded", () => {
                                new Chart(document.querySelector('#testt'), {
                                    type: 'pie',
                                    data: {
                                    labels: [
                                        'Paracetamol',
                                        'Antibiotics'
                                    ],
                                    datasets: [{
                                        label: 'My First Dataset',
                                        data: [10, 2],
                                        backgroundColor: [
                                        'rgb(255, 99, 132)',
                                        'rgb(54, 162, 235)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                    }
                                });
                                });
                            </script>
                            <!-- End Doughnut CHart -->

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
  
@push('script')
    <!-- <script src="{{ asset('js/datatable.js') }}"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.2/chart.min.js" integrity="sha512-zjlf0U0eJmSo1Le4/zcZI51ks5SjuQXkU0yOdsOBubjSmio9iCUp8XPLkEAADZNBdR9crRy3cniZ65LF2w8sRA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function(){
          
        });
    </script>
@endpush