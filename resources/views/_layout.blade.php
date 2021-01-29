<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shaftaloo! @yield('title')</title>
    <link rel="stylesheet" href="{{ fh(asset('vendor/bootstrap-4.6.0/css/bootstrap.min.css')) }}">
    <link rel="icon" href="{{ fh(asset('img/logo.png')) }}">
    @yield('head')
</head>
<body>

<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-2 mr-md-auto font-weight-normal">
        <img src="{{ asset('img/logo.png') }}" height="24" width="24" class="mr-2" style="top:-3px; position:relative"
             alt="Logo">
        Shaftaloo!
    </h5>
    <div>
        <a class="btn btn-outline-primary mr-1" href="{{ route('users.profile') }}">
            {{ '@' . auth()->user()->username }}
        </a>
        <a class="btn btn-outline-secondary" href="{{ route('users.sign-out') }}">Sign out</a>
    </div>
</div>

<div class="container py-2">
    @yield('content')
</div>

<script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper-1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.6.0/js/bootstrap.min.js') }}"></script>
@yield('scripts')

</body>
</html>
