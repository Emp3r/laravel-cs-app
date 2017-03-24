@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                @yield('form')
            </div>
        </div>

        @include('user.sidebar')
    </div>
</div>
@endsection
