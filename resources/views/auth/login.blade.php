@extends('layouts.app')

@section('color')
    class="color-default"
@endsection

@section('content')
<div class="container mainContainer">
    <div class="row justify-content-center">
        <div class="col-md-9 insideBox align-content-center">
            <div class="headerText align-self-center">
                ZALOGUJ SIĘ
            </div>
            <div class="loginForm col-md-4 offset-md-4">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group row">
                        <label for="email" class="col-form-label text-md-left text-default font-weight-bold">{{ __('E-mail') }}</label>
                        <input id="email" type="email" class="form-control border-default @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-form-label text-default font-weight-bold">{{ __('Hasło') }}</label>
                        <input id="password" type="password" class="form-control border-default
                        @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                        @enderror
                    </div>

                    <div class="form-group row">
                        <button type="submit" class="btn" id="loginButton">
                            {{ __('ZALOGUJ SIĘ') }}
                        </button>
                    </div>
                        @if (Route::has('register'))
                            <a class="btn btn-link text-default" href="{{ route('register') }}">
                                {{ __('Nie masz konta?') }} <b>{{ __('Zarejestruj się') }}</b>
                            </a>
                        @endif
                    <div>

                    </div>
                </form>
            </div>
            <div class="text-center" id="logo">
                <img class="logo" src="{{ asset('images/logo.png') }}" alt="Grupa Visit Logo"/>
            </div>
        </div>
    </div>
</div>
@endsection
