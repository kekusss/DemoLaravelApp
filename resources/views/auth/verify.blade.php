@extends('layouts.app')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Potwierdź swój adres Email') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Nowy link weryfikacyjny został wysłany na Twój adres email.') }}
                        </div>
                    @endif

                    {{ __('Aby przejść dalej potwierdź swój adres email.') }}
                    <br/>{{ __('Jeśli nie otrzymałeś maila') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknij tutaj by wysłać wiadomość ponownie') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
