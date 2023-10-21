@extends('layouts.app')

@section('title', 'Reset')

@section('content')

@component('components.navbar')
@endcomponent

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card p-5">

                <div class="card-body">

                    <h1 class="text-center mb-5">{{ __('Reset Password') }}</h1>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="{{__('Email')}}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">

                            <div class="col-lg-8 offset-lg-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fs-4" name="password" required autocomplete="new-password" placeholder="{{__('Password')}}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password-confirm" type="password" class="form-control fs-4" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-8 offset-lg-2">
                                <button type="submit" class="btn btn-th-primary text-white fs-4 rounded-0 w-100">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
