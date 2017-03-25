@extends('layouts.app')

@section('content')

<div class="container user-profile">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                {{-- <div class="panel-heading">Profil uživatele</div> --}}
                <div class="panel-body">
                    @if ($user->role->id > 1)
                        <p class="roles">
                            <span class="label label-{{ $user->role->id }}">
                                {{ $user->role->name }}
                            </span>
                        </p>
                    @endif
                    <div class="text-center">
                        <img src="{{ $user->avatarPath() }}" alt="" class="avatar-img">
                        <h4 class="text-center">{{ $user->name }}</h4>
                    </div>
                    <p class="text-center bio">
                        {{ $user->bio }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
