@extends('layouts.app')

@section('title', 'Register')

@section('content')

@component('components.navbar')
@endcomponent

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">

                <div class="card-body p-5">

                    <h1 class="text-center mb-5">{{ __('Welcome to XorTech') }}</h1>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror fs-4" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fs-4" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password-confirm" type="password" class="form-control fs-4" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm password') }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-8 offset-lg-2">
                                <button type="submit" class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                                    {{ __('Register') }}<i class="fa-regular fa-pen-to-square ms-2"></i>
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
