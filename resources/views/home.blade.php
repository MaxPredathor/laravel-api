@extends('layouts.app')
@section('content')
    <section class="container">
        <canvas class="my-4" id="myChart"></canvas>
        <canvas id="myPieChart"></canvas>
        <script>
            const ctx = document.getElementById('myChart');

            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: ['HTML', 'SASS', 'Vue', 'PHP', 'Laravel', 'Bootstrap'],
                    datasets: [{
                            label: '# of Projects',
                            data: [12, 19, 3, 5, 2, 3],
                            borderWidth: 1
                        },
                        {
                            label: '# of Test Projects',
                            data: [3, 10, 4, 2, 7, 12],
                            borderWidth: 1
                        }
                    ]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        </script>
        <script>
            const myPieChart = document.getElementById('myPieChart');
            new Chart(myPieChart, {
                type: 'pie',
                data: {
                    labels: ['Vue', 'Laravel', 'Both'],
                    datasets: [{
                        data: [50, 30, 20],
                        backgroundColor: ['green', 'purple', 'black'],
                        hoverOffset: 4
                    }]
                },
            });
        </script>
    </section>
@endsection
