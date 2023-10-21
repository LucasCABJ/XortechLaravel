@extends('layouts.app')

@section('title', 'Forgot password')

@section('content')

@component('components.navbar')
@endcomponent


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body p-5">

                    <h1 class="text-center mb-5">{{ __('Reset Password') }}</h1>

                    @if (session('status'))
                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <div class="alert alert-success fs-5" role="alert">
                                    {{ session('status') }}
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="{{ __('Email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-lg-8 offset-lg-2">
                                <button type="submit" class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                                    {{ __('Send Password Reset Link') }}
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
