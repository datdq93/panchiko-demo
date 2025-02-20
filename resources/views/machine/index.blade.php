@extends('layout.app')

@section('content')
    <div class="p-3">
        <a href="{{ route('panchikos') }}" class="btn btn-primary"><i class="pr-1 fa-solid fa-house"></i> Home</a>
        <div>
            <h2 class="py-3">{{ $panchiko->name }}</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-primary">
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
                                <td>
                                    <a @if (count($machine->machineCharts) == 0) class="text-danger"
                                        @else class="text-success" @endif
                                        href="{{ route('machine.chart', [
                                            'panchiko_id' => $panchiko->id,
                                            'machine_id' => $machine->id,
                                        ]) }}"
                                        rel="noopener noreferrer">{{ $machine->name }}</a>
                                </td>
                                <td><a
                                        href="{{ $machine->title_filter_url }}">{{ \Str::limit($machine->title_filter_url, 100, '...') }}</a>
                                </td>
                                <td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
