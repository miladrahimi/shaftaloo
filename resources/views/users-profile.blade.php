@extends('_layout')

@section('title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">My Profile</div>

                <form class="card-body" method="post" action="{{ route('users.profile') }}">
                    @include('_alerts')

                    <p>Username: {{ '@' . $u->username }}</p>

                    <hr>

                    <p>Fill the password fields to change your password.</p>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="New password">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control"
                               placeholder="Confirm new password">
                    </div>

                    <hr>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="{{ route('transactions.index') }}" class="btn btn-secondary">Back</a>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection