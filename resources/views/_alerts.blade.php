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

@if (session('success'))
    <div class="alert alert-success">
        <ul class="pl-3 m-0">
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif