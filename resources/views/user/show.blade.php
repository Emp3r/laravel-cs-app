@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Profil uživatele</div>
                <div class="panel-body">
                    <p class="text-center">
                        <img src="{{ $user->avatarPath() }}" alt="" class="avatar-img">
                    </p>
                    <ul class="list-group">
                        <li class="list-group-item">Jméno: {{ $user->name }}</li>
                        <li class="list-group-item">Email: {{ $user->email }}</li>
                        <li class="list-group-item">Typ uživatele: {{ $user->role->name }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
