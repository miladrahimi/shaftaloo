<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ config('app.name') }} @yield('title')</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
          integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="icon" href="{{ asset('favicon.ico?md5=ffc8beb2a018b4aca71c3ab08d8fe540') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('manifest.json?md5=ba4a3d56fd7a6dfe0479fb816b1c846a') }}">
    @yield('head')
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-2 mr-md-auto font-weight-normal">
        <img src="{{ asset('img/logo.png') }}" height="24" width="24" class="mr-2" style="top:-3px; position:relative"
             alt="Logo">
        {{ config('app.name') }}
    </h5>
    <div>
        <a class="btn btn-outline-primary mr-1" href="{{ route('users.profile') }}">
            {{ '@' . Auth::user()->username }}
        </a>
        <a class="btn btn-outline-secondary" href="{{ route('users.sign-out') }}">Sign out</a>
    </div>
</div>

<div class="container py-2">
    @yield('content')
</div>

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
        crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k"
        crossorigin="anonymous"></script>
@yield('scripts')

</body>
</html>