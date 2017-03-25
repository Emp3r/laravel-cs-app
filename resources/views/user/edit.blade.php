@extends('user.settings')

@section('heading', 'Nastavení účtu')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <label for="name" class="col-md-4 control-label">Jméno</label>
        <div class="col-md-6">
            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') ? old('name') : $user->name }}" required>
            @if ($errors->has('name'))
                <span class="help-block">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('slug') ? ' has-error' : '' }}">
        <label for="slug" class="col-md-4 control-label">Adresa profilu</label>
        <div class="col-md-6">
            <input id="slug" type="text" class="form-control" name="slug" value="{{ old('slug') ? old('slug') : $user->slug }}" required>
            @if ($errors->has('slug'))
                <span class="help-block">
                    <strong>{{ $errors->first('slug') }}</strong>
                </span>
            @endif
            <span class="help-block helper-slug">
                Váš profil bude na {{ url('/uzivatel/') }}/<span>{{ $user->slug }}</span>
            </span>
        </div>
    </div>

    <div class="form-group{{ $errors->has('bio') ? ' has-error' : '' }}">
        <label for="bio" class="col-md-4 control-label">O mně</label>
        <div class="col-md-6">
            <textarea name="bio" id="bio" class="form-control" rows="6">{{ old('bio') ? old('bio') : $user->bio }}</textarea>
            @if ($errors->has('bio'))
                <span class="help-block">
                    <strong>{{ $errors->first('bio') }}</strong>
                </span>
            @else
                <span class="help-block helper-bio">
                    Maximálně <span>140</span> znaků
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
        <label for="avatar" class="col-md-4 control-label">Profilový obrázek</label>
        <div class="col-md-6 info">
            <img src="{{ $user->avatarPath() }}" alt="" class="avatar-img">
            <input type="file" name="avatar" id="avatar">
            @if ($errors->has('avatar'))
                <span class="help-block">
                    <strong>{{ $errors->first('avatar') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-4 control-label">Profil vytvořen</label>
        <div class="col-md-6 info">
            {{ $user->created_at->format("d. n. Y") }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Typ uživatele</label>
        <div class="col-md-6 info">
            {{ $user->role->name }} {{ $user->verified ? '' : '&nbsp; (Neověřený e-mail)' }}
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Upravit profil
            </button>
        </div>
    </div>
</form>
@endsection
