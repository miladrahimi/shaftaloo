@extends('_layout')

@section('title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            @include('_alerts')
            <form method="post" action="{{ route('profile.update') }}">
                <div class="form-group">
                    <label>Username:</label>
                    <input type="text" class="form-control" value="{{ $u->username }}" readonly title="Username">
                </div>
                <div class="form-group">
                    <label>Password:</label>
                    <input type="password" name="password" class="form-control" placeholder="New password"
                           title="Password">
                </div>
                <div class="form-group">
                    <input type="password" name="password_confirmation" class="form-control"
                           placeholder="Confirm new password" title="Confirm new password">
                </div>

                <hr>

                <div class="form-group">
                    @csrf
                    <input type="submit" class="btn btn-primary btn-block" value="Update">
                </div>
            </form>
        </div>
    </div>
@endsection
