@extends('layouts.app')

@section('title', __('Edit User'))

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js', 'resources/js/profilePicChange.js'])
@endsection

@section('modals')
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    @if (Session::has('passwordUpdated'))
        @vite(['resources/js/successPasswordUpdate.js'])
    @elseif(Session::has('userUpdated'))
        @vite(['resources/js/successAccountUpdate.js'])
    @elseif(Session::has('invalidId'))
        @vite(['resources/js/errorUserSettings.js'])
    @endif

    @if ($errors->has('email') || $errors->has('password') || $errors->has('image'))
        @vite(['resources/js/errorUserSettings.js'])
    @endif

    <div class="container py-5" style="min-height: 100vh">
        <div class="row">
            <a href="{{ route('user.index') }}" class="col-md-8 offset-md-2 pb-3 text-decoration-none link-secondary"><-
                    {{ __('Go back') }}</a>
                    <div class="col-md-8 offset-md-2 mb-3">
                        <div class="card shadow-sm">

                            <div class="card-body p-5">

                                <div class="row">
                                    <div class="col-lg-5 d-lg-block d-flex justify-content-center align-items-center">
                                        <form action="{{ route('user.edit_profile_pic', $user->id) }}" class="d-none p-3"
                                            method="POST" id="profilepic-upload-form" enctype="multipart/form-data">
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
                                                    <button type="submit"
                                                        class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                                                        {{ __('Update') }}</i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                        <div class="rounded position-relative profilepic-container"
                                            id="profilepic-container" style="aspect-ratio : 1 / 1;">
                                            <div
                                                class="position-absolute bg-dark rounded justify-content-center align-items-center profilepic-change">
                                                <i class="bg-dark fa-solid fa-pencil text-white h1"></i>
                                            </div>
                                            <img src="@if ($user->image == '' || !Storage::disk('local')->has('public/images/usup/' . $user->image)) {{ asset('assets/img/default-male.png') }}@else{{ asset('storage/images/usup/' . $user->image) }} @endif"
                                                class="rounded border border-th-grey border-2" alt="Current Profile Picture"
                                                style="height: 100%; width:100%; object-fit:cover">

                                        </div>
                                    </div>
                                    <div class="col-lg-7 pt-3">
                                        <h1 class="text-th-secondary">{{ $user->name }} <span
                                                class="h6 text-th-grey">({{ $user->email }})</span></h1>
                                        <form class="w-100 mb-3" action="{{ route('user.update_role', $user->id) }}"
                                            method="POST" id="changeRoleForm">
                                            @csrf
                                            @method('PUT')
                                            <select class="form-select d-lg-inline-block w-50 outline-th-secondary rounded-0" name="role_id">
                                                <option value="{{ $user->role->id }}" selected>
                                                    {{ ucfirst($user->role->name) }}
                                                </option>
                                                @if ($user->role->name == 'admin')
                                                    <option value="2">
                                                        Vendor</option>
                                                    <option value="3">
                                                        Customer</option>
                                                @elseif ($user->role->name == 'vendor')
                                                    <option value="1">
                                                        Admin</option>
                                                    <option value="3">
                                                        Customer</option>
                                                @else
                                                    <option value="1">
                                                        Admin</option>
                                                    <option value="2">
                                                        Vendor</option>
                                                @endif
                                            </select>
                                            <button type="submit"
                                                class="btn btn-th-info text-white rounded-0 w-50 d-inline-block">{{ __('Update Role') }}</button>
                                        </form>

                                        <form action="{{ route('user.edit_password', $user->id) }}" method="POST"
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
                                                class="btn btn-th-info text-white fs-3 rounded-0">{{ __('Update Password') }}</button>
                                        </form>

                                        <button type="button" id="changePasswordBtn" data-micromodal-trigger="modal-1"
                                            class="d-block w-50 mb-2 py-2 mb-2 w-75 px-3 fs-5 btn btn-th-info rounded-0 text-white d-flex justify-content-center align-items-center"><i
                                                class="fa-solid fa-key pe-2"></i>{{ __('Edit Password') }}</button>

                                        <form action="{{ route('user.update_user_email', $user->id) }}" method="POST"
                                            id="changeEmailForm" class="d-none p-3">
                                            @csrf
                                            @method('PUT')
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror fs-4"
                                                        name="email" placeholder="{{ __('New Email') }}">

                                                    @error('email')
                                                        <span class="invalid-feedback text-left" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-12">
                                                    <input id="email-confirm" type="email" class="form-control fs-4"
                                                        name="email_confirmation" autocomplete="new-email"
                                                        placeholder="{{ __('Confirm Email') }}">
                                                </div>
                                            </div>
                                            <button type="submit"
                                                class="btn btn-th-info text-white fs-3 rounded-0 d-flex justify-content-center align-items-center">{{ __('Update Email') }}</button>
                                        </form>

                                        <button type="button" id="changeEmailBtn" data-micromodal-trigger="modal-1"
                                            class="d-block py-2 px-3 fs-5 w-75 mb-2 btn btn-th-info rounded-0 text-white d-flex justify-content-center align-items-center"><i
                                                class="fa-solid fa-envelope pe-2"></i>{{ __('Change Email') }}</button>

                                        @if ($user->active == 1)
                                            <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="d-block w-50 py-2 px-3 fs-5 w-75 btn btn-danger rounded-0 text-white d-flex justify-content-center align-items-center"><i
                                                        class="fa-solid fa-user-minus pe-2"></i>
                                                    {{ __('Inactivate User') }}</button>
                                            </form>
                                        @else
                                            <form action="{{ route('user.reactivate', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit"
                                                    class="d-block w-50 py-2 px-3 fs-5 w-75 btn btn-success rounded-0 text-white d-flex justify-content-center align-items-center"><i
                                                        class="fa-solid fa-user-plus"></i>{{ __('Activate User') }}</button>
                                            </form>
                                        @endif

                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
        </div>
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/usersettings.js'])
@endsection
