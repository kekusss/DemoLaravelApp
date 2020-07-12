@extends('layouts.app')

@section('color')
    class="color-default"
@endsection

@section('content')
    <div class="container mainContainer">
        <div class="row justify-content-center">
            <div class="col-md-9 insideBox align-content-center">
                <div class="headerText align-self-center">
                    REJESTRACJA
                </div>
                <div class="loginForm col-md-4 offset-md-4">
                    <form method="POST" action="{{ route('register') }}" onsubmit="return validateRegisterForm();">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-form-label text-md-left text-default font-weight-bold">{{ __('Login') }}</label>
                            <input id="name" type="text" class="form-control border-default @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-form-label text-md-left text-default font-weight-bold">{{ __('E-Mail') }}</label>
                            <div class="input-group">
                                <input id="email" type="email" onkeyup="validateEmail();" oninput="validateEmail();" class=" form-control border-default @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="emailStatus"><i class="fa fa-check"></i> </span>
                                </div>
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-form-label text-default font-weight-bold">{{ __('Hasło') }}</label>
                            <div class="input-group">
                                <input id="password" onkeyup="validatePassword();" oninput="validatePassword();" type="password" class="form-control border-default
                                @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                <div class="input-group-append">
                                    <span class="input-group-text" id="passwordStatus"><i class="fa fa-check"></i> </span>
                                </div>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group row">
                            <button type="submit" class="btn" id="loginButton">
                                {{ __('ZAREJESTRUJ SIĘ') }}
                            </button>
                        </div>
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
