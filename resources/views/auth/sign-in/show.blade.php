<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shaftaloo! Sign in</title>
    <link rel="stylesheet" href="{{ fh(asset('vendor/bootstrap-4.6.0/css/bootstrap.min.css')) }}">
    <link rel="icon" href="{{ fh(asset('img/logo.png')) }}">
</head>
<body>

<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col col-md-4 text-center">
            <img src="{{ asset('img/logo.png') }}" width="64" height="auto" alt="Logo" class="mb-3">
            @include('_alerts')
            <form method="post" action="{{ route('auth.sign-in.do') }}">
                <div class="form-group">
                    <input type="text" name="username" class="form-control" placeholder="Username"
                           value="{{ old('username') }}" title="Username">
                </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password"
                           title="Password">
                </div>
                <div class="form-group">
                    @csrf
                    <input type="submit" class="btn btn-block btn-primary" value="Sign in">
                </div>
            </form>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper-1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.6.0/js/bootstrap.min.js') }}"></script>

</body>
</html>
