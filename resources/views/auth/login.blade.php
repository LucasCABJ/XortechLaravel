@extends('layouts.app')

@section('title', 'Login')

@section('content')

@component('components.navbar')
@endcomponent

<div class="container py-5" style="min-height: 100vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">

                <div class="card-body p-5">

                    <h1 class="text-center mb-5">{{ __('Login to XorTech') }}</h1>

                    @if(session('error'))
{{--                        @dd(session('error'))--}}
                        <div id="errorMessage" data-error="{{ session('error') }}"></div>
                    @endif

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{__('Email')}}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fs-4" name="password" required autocomplete="current-password" placeholder="{{__('Password')}}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="form-check form-switch ps-5">
                                    <input class="form-check-input fs-5" type="checkbox" role="switch" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label fs-5" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-8 offset-lg-2">

                                @if (Route::has('password.request'))
                                    <a class="btn btn-outline-th-secondary rounded-0 fs-4 d-inline-block w-100" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-th-primary text-white rounded-0 fs-4 d-inline-block w-100 mt-2">
                                    <i class="fa-solid fa-right-to-bracket me-2"></i>{{ __('Login') }}
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

@section('scripts')
    @vite(['resources/js/errorMessage.js'])
@endsection
