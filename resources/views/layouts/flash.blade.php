@if ($flash = session('message'))
    <div class="alert alert-success" role="alert">
        {{ $flash }}
    </div>
@endif
