@extends('layouts.app')

@section('content')
<div class="container">

    @include('layouts.flash')

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nástěnka</div>

                <div class="panel-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quasi aliquam, sit, eum at quos distinctio necessitatibus incidunt ad dolorum nemo omnis vel sapiente natus ut facere, sint fugit nam dolore.</p>
                    <p>
                        @if (Auth::id() && Auth::user()->verified)
                            E-mail ověřen!
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
