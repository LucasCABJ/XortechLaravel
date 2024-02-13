@extends('layouts.app')

@section('title', __('Settings'))

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js', 'resources/js/profilePicChange.js'])
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    @if (Session::has('passwordUpdated'))
        @vite(['resources/js/successPasswordUpdate.js'])
    @elseif(Session::has('userUpdated'))
        @vite(['resources/js/successAccountUpdate.js'])
    @endif

    <div class="container py-5" style="min-height: 100vh">
        <div class="row">
            <a href="{{ route('home') }}" class="col-md-8 offset-md-2 pb-3 text-decoration-none link-secondary"><-
                    {{ __('Go back') }}</a>
                    <div class="col-md-8 offset-md-2 mb-3">
                        <div class="card shadow-sm">

                            <div class="card-body p-5">

                                <div class="row">
                                    <div class="col-lg-5 d-lg-block d-flex justify-content-center align-items-center">
                                        <form action="{{ route('user.update_profile_pic') }}" class="d-none p-3" method="POST" id="profilepic-upload-form" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input id="image" type="file"
                                                        class="form-control @error('image') is-invalid @enderror fs-4"
                                                        name="image" value="{{ old('image') }}" autocomplete="image">
        
                                                    @error('image')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                            
                                            <div class="row mb-0">
                                                <div class="col-12">
                                                    <button type="submit" class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                                                        {{ __('Update') }}</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="rounded position-relative profilepic-container" id="profilepic-container" style="aspect-ratio : 1 / 1;">
                                            <div class="position-absolute bg-dark rounded justify-content-center align-items-center profilepic-change"><i class="bg-dark fa-solid fa-pencil text-white h1"></i></div>
                                            <img src="@if(Auth::user()->image == "" || !Storage::disk("local")->has("public/images/usup/".Auth::user()->image)){{asset('assets/img/default-male.png') }}@else{{asset('storage/images/usup/'.Auth::user()->image)}} @endif" class="rounded border border-th-grey border-2"
                                                alt="Current Profile Picture"
                                                style="height: 100%; width:100%; object-fit:cover">

                                        </div>
                                    </div>
                                    <div class="col-lg-7 pt-3">
                                        <h1 class="text-th-secondary">{{ Auth::user()->name }}</h1>
                                        <h3 class="h6 text-th-grey bg-secondary d-inline-block py-2 px-3">Administrador</h3>

                                        <form action="{{ route('user.update_password') }}" method="POST"
                                            id="changePasswordForm" class="d-none p-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input id="password" type="password"
                                                        class="form-control @error('password') is-invalid @enderror fs-4"
                                                        name="password" autocomplete="new-password"
                                                        placeholder="{{ __('Password') }}">

                                                    @error('password')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input id="password-confirm" type="password" class="form-control fs-4"
                                                        name="password_confirmation" autocomplete="new-password"
                                                        placeholder="{{ __('Confirm password') }}">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-th-primary text-white fs-3 rounded-0">{{ __('Update Password') }}</button>
                                        </form>

                                        <button type="button" id="changePasswordBtn" data-micromodal-trigger="modal-1"
                                            class="d-block py-2 px-3 fs-5 btn btn-th-primary rounded-0 text-white">{{ __('Reset Password') }}</button>

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-md-8 offset-md-2">
                        <div class="card shadow-sm">

                            <div class="card-body p-5">

                                <h2 class="text-bold mb-3">{{ __('User Settings') }}</h2>

                                <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                
                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="name" class='form-label'>{{ __('Name') }}</label>
                                            <input id="name" type="text"
                                                class="form-control @error('name') is-invalid @enderror fs-4" name="name"
                                                value="{{ old('name') ? old('name') : Auth::user()->name }}"
                                                autocomplete="name" placeholder="{{ __('Name') }}">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-5">
                                        <div class="col-12">
                                            <label for="email" class='form-label'>Email</label>
                                            <input id="email" type="email"
                                                class="form-control @error('email') is-invalid @enderror fs-4"
                                                name="email"
                                                value="{{ old('email') ? old('email') : Auth::user()->email }}"
                                                autocomplete="email" placeholder="{{ __('Email') }}">

                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-0">
                                        <div class="col-12">
                                            <button type="submit"
                                                class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                                                {{ __('Update account') }}<i class="fa-regular fa-pen-to-square ms-2"></i>
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
    @vite(['resources/js/usersettings.js'])
@endsection
