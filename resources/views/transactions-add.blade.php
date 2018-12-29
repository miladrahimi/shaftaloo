@extends('_layout')

@section('title', 'Add Transaction')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">Add Transaction</div>

                <form class="card-body" method="post" action="{{ route('transactions.add') }}">
                    @include('_alerts')

                    <p>Add a new transaction:</p>

                    <div class="form-group">
                        <input type="text" name="title" class="form-control" placeholder="Title"
                               value="{{ old('title') }}">
                    </div>

                    <div class="input-group mb-3 pl-4">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">?</span>
                        </div>
                        <input type="number" id="helper" class="form-control" placeholder="Helper: I have paid...">
                    </div>

                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <input type="checkbox" id="{{ $u->username }}_box" aria-label="" checked>
                            </div>
                        </div>
                        <input type="number" name="{{ $u->username }}" class="form-control"
                               placeholder="{{ '@' . $u->username }}" value="{{ old($u->username) }}">
                    </div>

                    @foreach($users as $user)
                        @if($user->id == Auth::id()) @continue @endif

                        <div class="input-group form-group">
                            <div class="input-group-prepend">
                                <div class="input-group-text">
                                    <input type="checkbox" id="{{ $user->username }}_box" aria-label="" checked>
                                </div>
                            </div>
                            <input type="number" name="{{ $user->username }}" class="form-control contribution"
                                   placeholder="{{ '@'.$user->username }}" value="{{ old($user->username) }}">
                        </div>
                    @endforeach

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Add">
                        <a href="{{ route('transactions') }}" class="btn btn-secondary">Back</a>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $('#helper').change(function () {

        });
    </script>
@endsection