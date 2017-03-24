@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Změna hesla</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('user.update.password') }}">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}

                        <input type="hidden" name="id" value="{{ $user->id }}">

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Současné heslo</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <br>

                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label for="newpassword" class="col-md-4 control-label">Nové heslo</label>
                            <div class="col-md-6">
                                <input id="newpassword" type="password" class="form-control" name="newpassword" required>
                                @if ($errors->has('newpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="newpassword-confirm" class="col-md-4 control-label">Ještě jednou pro kontrolu</label>
                            <div class="col-md-6">
                                <input id="newpassword-confirm" type="password" class="form-control" name="newpassword_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Uložit nové heslo
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        @include('user.sidebar')
    </div>
</div>
@endsection