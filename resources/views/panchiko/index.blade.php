@extends('layout.app')

@section('content')
<div class="row">
    <form action="{{ route('get_data') }}" method="post">
        @csrf
        <label for="">Link: </label>
        <input type="text" name="link">

        <button class="btn btn-primary">Crawl data</button>

    </form>
</div>
    <div class="">
        <div class="page-title">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title-inner">
                        <div class="page-title-details">
                            <h2>Panchikos</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Panchiko Name</th>
                    <th scope="col">Panchiko ID</th>
                    <th scope="col">URL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($panchikos as $key => $panchiko)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td><a href="{{ route('machines', ['panchiko_id' => $panchiko->id]) }}">{{ $panchiko->name }}</a>
                        </td>
                        <td>{{ $panchiko->panchiko_url_id }}</td>
                        <td> <a target="_blank" href="{{ $panchiko->url }}">{{ $panchiko->url }}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
