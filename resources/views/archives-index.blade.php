@extends('_layout')

@section('title', 'Archives')

@section('content')
    <div class="row justify-content-center mt-2">
        <div class="col">
            <div class="card">
                <div class="card-header">Archives</div>

                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Author</th>
                            <th scope="col">Time</th>
                            <th scope="col">Description</th>
                            <th scope="col">Snapshot</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($archives as $archive)
                            <tr>
                                <td>{{ $archive->id }}</td>
                                <td>{{ '@' . $archive->user->username }}</td>
                                <td>{{ $archive->created_at }}</td>
                                <td>{{ $archive->description ?: 'N/A' }}</td>
                                <td>{{ $archive->id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back to transactions</a>
                </div>

                <div class="card-footer text-muted">&copy; {{ date('Y ') . config('app.name') }}</div>
            </div>
        </div>
    </div>
@endsection