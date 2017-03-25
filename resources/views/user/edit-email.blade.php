@extends('user.settings')

@section('heading', 'Změna e-mailu')

@section('form')
<form class="form-horizontal" role="form" method="POST" action="{{ route('user.update.email') }}">
    {{ csrf_field() }}
    {{ method_field('PUT') }}

    <input type="hidden" name="id" value="{{ $user->id }}">

    <div class="form-group">
        <label class="col-md-4 control-label">Současný e-mail</label>
        <div class="col-md-6 info">
            {{ $user->email }}
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-4 control-label">Ověřený</label>
        <div class="col-md-6 info">
        @if ($user->verified)
            Ano
        @else
            Ne
        @endif
        </div>
    </div>
    <br>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-4 control-label">Nový e-mail</label>
        <div class="col-md-6">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="form-group">
        <label for="email-confirm" class="col-md-4 control-label">Ještě jednou pro kontrolu</label>
        <div class="col-md-6">
            <input id="email-confirm" type="email" class="form-control" name="email_confirmation" required>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-6 col-md-offset-4">
            <button type="submit" class="btn btn-primary">
                Uložit nový e-mail
            </button>
        </div>
    </div>
</form>
@endsection
