@extends('layout.app')

@section('content')
<div class="row">
    <h5><a href="{{ route('panchikos') }}">Home</a></h5>
</div>
    <div class="">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-inner">
                        <div class="page-title-details">
                            <h2>{{ $panchiko->name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Machine Name</th>
                        <th scope="col">Title Filter</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $key => $machine)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td><a 
                            @if (count($machine->machineCharts) == 0)
                                style ="color: red"
                            @endif
                            href="{{ route('machine.chart', [
                            'panchiko_id' => $panchiko->id,
                            'machine_id' => $machine->id 
                            ]) }}"  rel="noopener noreferrer">{{ $machine->name }}</a></td>
                            <td><a
                                href="{{ $machine->title_filter_url }}">{{ \Str::limit( $machine->title_filter_url, 100, '...') }}</a></td>
                            <td> 
                           
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endsection
