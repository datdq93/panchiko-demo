@extends('layout.app')

@section('content')
<div class="container">
    <div class="row">
        <h5><a href="{{ route('machines', ['panchiko_id'  => $machine->panchiko_id ]) }}">Back</a></h5>
    </div>
    <div class="row">
        @foreach ($machine->machineCharts as $key => $chart)
            <div>
                <canvas id="chart{{ $key }}" data-chart-data="{{ json_encode($chart->chart_data) }}"></canvas>
           </div>
        @endforeach
    </div>
</div>

<script>
    const totalChart = parseInt('{{ count($machine->machineCharts) }}');

    document.addEventListener("DOMContentLoaded", function () {

        for (let index = 0; index < totalChart; index++) {
            
            var canvas = document.getElementById('chart' + index);
            var data = JSON.parse(canvas.getAttribute('data-chart-data')); // Lấy dữ liệu từ attribute
            var ctx = canvas.getContext('2d');
            var labels = new Array(data.length).fill('');
            console.log(data);
            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: labels,  // Trục X
                    datasets: [{
                        label: 'Machine Data',
                        data: data,  // Trục Y
                        fill: false,
                        borderColor: 'rgb(255, 83, 111)',
                        lineTension: 0,
                        radius: 3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: { display: true }
                    }
                }
            });
        }
        
        });
</script>
  
@endsection
