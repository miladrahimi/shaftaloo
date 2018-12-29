<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shaftaloo! Sign in</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('favicon.ico?md5=ffc8beb2a018b4aca71c3ab08d8fe540') }}" type="image/x-icon">
</head>
<body>

<div class="container pt-5">
    <div class="row justify-content-center">
        <div class="col col-md-4">
            <div class="card">
                <div class="card-header">Shaftaloo!</div>

                <form class="card-body" method="post" action="{{ route('auth.sign-in') }}">
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
                        <input type="text" name="username" class="form-control" placeholder="Username">
                    </div>

                    <div class="form-group">
                        <input type="password" name="password" class="form-control" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <input type="submit" name="sign-in" class="btn btn-primary" value="Sign in">
                    </div>
                </form>

                <div class="card-footer text-muted">&copy; {{ date('Y ') . config('app.name') }}</div>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>

</body>
</html>