@extends('_layout')

@section('title', 'Transactions')

@section('content')
    <a href="{{ route('transactions.add') }}" class="btn btn-primary">Add Transaction</a>

    <table class="table table-sm table-bordered table-striped table-responsive-sm">
        <thead>
        <tr>
            <th scope="col">User</th>
            <th scope="col">Balance</th>
            <th scope="col">Contributions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td>{{ '@' . $user->username }}</td>
                <td>
                                    <span class="badge badge-{{ $balance_color($balances[$user->id] ?? 0) }}">
                                        {{ $balances[$user->id] ?? 0 }}
                                    </span>
                </td>
                <td>{{ $contributions[$user->id] ?? 0 }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="row justify-content-center mt-2">
        <div class="col">
            <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped table-responsive-sm">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Time</th>
                            <th scope="col">Contributions</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->id }}</td>
                                <td>{{ $transaction->title }}</td>
                                <td>{{ '@' . $transaction->user->username }}</td>
                                <td>{!! str_replace(' ', '<br>', $jd($transaction->created_at)) !!}</td>
                                <td>
                                    @foreach($transaction->contributions as $contribution)
                                        <span class="badge badge-{{ $balance_color($contribution->value) }}">
                                            {{ '@' . $contribution->user->username }}:{{ $contribution->value }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @if($transaction->user_id == Auth::id())
                                        <form method="post" action="{{ route('transactions.delete') }}">
                                            {{ method_field('delete') }} {{ csrf_field() }}
                                            <input type="hidden" name="id" value="{{ $transaction->id }}">
                                            <input type="submit" value="&cross;" class="btn btn-danger"
                                                   style="border-radius: 50%"
                                                   onclick="return confirm('Delete transaction?')">
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer text-muted">&copy; {{ date('Y ') . config('app.name') }}</div>
            </div>
        </div>
    </div>
@endsection
