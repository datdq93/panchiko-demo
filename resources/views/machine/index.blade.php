@extends('layout.app')

@section('content')
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Machine Name</th>
                        <th scope="col">Title Filter</th>
                        <th scope="col">URL</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($machines as $key => $machine)
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $machine->name }}</td>
                            <td>{{ $machine->title_filter_url }}</td>
                            <td> <a
                                    href="{{ $panchiko->url . $machine->title_filter_url }}">{{ $panchiko->url . '?kishu=' . $machine->title_filter_url }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
