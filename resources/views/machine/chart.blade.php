@extends('layout.app')

@section('content')
    <div class="p-3">
        <div class="flex gap-5 pt-2 pb-4">
            <a href="{{ route('machines', ['panchiko_id' => $machine->panchiko_id]) }}" class="btn btn-primary"><i
                    class="pr-1 fa-solid fa-house"></i> Back</a>
            <a href="{{ route('panchikos') }}" class="btn btn-primary"><i class="pr-1 fa-solid fa-house"></i> Home</a>
        </div>
        <h2 class="py-3">{{ $machine->name }}</h2>

        <div class="row">
            @foreach ($machine->machineCharts as $key => $chart)
                <div class="justify-center flex-column d-flex align-items-center">
                    <h5>{{ $chart->chart_name }}</h5>
                    <div>
                        <canvas style="min-width:160px; min-height: 160px;" id="chart{{ $key }}"
                            data-chart-data="{{ json_encode($chart->chart_data) }}"></canvas>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <script>
        const totalChart = parseInt('{{ count($machine->machineCharts) }}');

        document.addEventListener("DOMContentLoaded", function() {

            for (let index = 0; index < totalChart; index++) {

                var canvas = document.getElementById('chart' + index);
                var data = JSON.parse(canvas.getAttribute('data-chart-data')); // Lấy dữ liệu từ attribute
                var ctx = canvas.getContext('2d');
                var labels = new Array(data.length).fill('');
                console.log(data);
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels, // Trục X
                        datasets: [{
                            label: 'Machine Data',
                            data: data, // Trục Y
                            fill: false,
                            borderColor: 'rgb(255, 83, 111)',
                            lineTension: 0,
                            radius: 3
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: true
                            }
                        }
                    }
                });
            }

        });
    </script>
@endsection
