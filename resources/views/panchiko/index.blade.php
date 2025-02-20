@extends('layout.app')

@section('content')
    <div class="p-3">
        <div class="pb-2">
            <form action="{{ route('get_data') }}" method="post" class="flex justify-center align-content-center">
                @csrf
                <label for="">Link: </label>
                <input type="text" name="link" class="h-10 px-2 py-1 border rounded border-info"
                    style="width:15rem; height: 2rem;">
                <button class="btn btn-primary">Crawl data</button>
            </form>
        </div>
        <div>
            <h2 class="pb-3">Panchiko</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead class="bg-primary">
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
                                <td><a
                                        href="{{ route('machines', ['panchiko_id' => $panchiko->id]) }}">{{ $panchiko->name }}</a>
                                </td>
                                <td>{{ $panchiko->panchiko_url_id }}</td>
                                <td> <a target="_blank" href="{{ $panchiko->url }}">{{ $panchiko->url }}</a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
