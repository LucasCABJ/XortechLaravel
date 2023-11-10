@extends('layouts.app')

@section('content')

@component('components.navbar')    
@endcomponent


<div class="container py-5" style="min-height: 100vh">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">

                <div class="card-body p-5">

                    <h1 class="text-center mb-5">{{ Auth::user()->name . __("'s User Settings") }}</h1>

                    <img src="{{ asset('./images/usup/'.Auth::user()->image) }}" alt="Current Profile Picture" class="img-fluid">

                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <label for="form-label">Profile Pic</label>
                                <input id="image" type="file" class="form-control @error('image') is-invalid @enderror fs-4" name="image" value="{{ old('image') }}" autocomplete="image" autofocus placeholder="{{ __('Profile Pic') }}">

                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror fs-4" name="name" value="{{ Auth::user()->name }}" autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4" name="email" value="{{ Auth::user()->email }}" autocomplete="email" placeholder="{{ __('Email') }}">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fs-4" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-lg-8 offset-lg-2">
                                <input id="password-confirm" type="password" class="form-control fs-4" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm password') }}">
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