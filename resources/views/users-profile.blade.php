@extends('_layout')

@section('title', 'My Profile')

@section('content')
    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-header">My Profile</div>

                <form class="card-body" method="post" action="{{ route('users.profile') }}">
                    @include('_alerts')

                    <p>My Username: {{ '@' . $u->username }}</p>

                    <div class="form-group">
                        <input type="password" name="old_password" class="form-control" placeholder="Old Password">
                    </div>

                    <div class="form-group">
                        <input type="password" name="new_password" class="form-control" placeholder="New Password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Update">
                        <a href="{{ route('transactions') }}" class="btn btn-secondary">Back</a>
                    </div>

                    {{ csrf_field() }}
                </form>
            </div>
        </div>
    </div>
@endsection