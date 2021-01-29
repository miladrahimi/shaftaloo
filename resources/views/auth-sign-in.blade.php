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
        <div class="col col-md-4">
            <div class="card">
                <div class="card-header">Shaftaloo!</div>

                <form class="card-body" method="post" action="{{ route('auth.sign-in.do') }}">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="pl-3 m-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <ul class="pl-3 m-0">
                                <li>{{ session('error') }}</li>
                            </ul>
                        </div>
                    @endif

                    {{ csrf_field() }}

                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"
                               value="{{ old('username') }}" title="Username">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password"
                               title="Password">
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-block btn-primary" value="Sign in">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper-1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.6.0/js/bootstrap.min.js') }}"></script>

</body>
</html>
