<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Shaftaloo! @yield('title')</title>
    <link rel="stylesheet" href="{{ asset('vendor/bootstrap-4.6.0/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-5.12.0/css/all.min.css') }}">
    <link rel="icon" href="{{ fh(asset('img/logo.png')) }}">
    @yield('head')
</head>
<body>

<header class="bg-white border-bottom shadow-sm text-center py-2 mb-3">
    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4">
        <img src="{{ asset('img/logo.png') }}" width="20" height="auto" alt="Logo">
    </a>
    <a class="btn btn-outline-primary px-4" href="{{ route('users.profile.show') }}">
        <i class="fas fa-user"></i>
    </a>
    <a class="btn btn-outline-danger px-4" href="{{ route('users.sign-out') }}">
        <i class="fas fa-power-off"></i>
    </a>
</header>

<div class="container py-2">
    @yield('content')
</div>

<script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
<script src="{{ asset('vendor/popper-1/popper.min.js') }}"></script>
<script src="{{ asset('vendor/bootstrap-4.6.0/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('vendor/fontawesome-5.12.0/js/all.min.js') }}"></script>
@yield('scripts')

</body>
</html>
