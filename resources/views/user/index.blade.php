@extends('layouts.app')

@section('title', 'Users')

@section('headextra')
    @vite(['node_modules/jquery/dist/jquery.min.js'])
@endsection

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4" style="min-height: 80vh">

        @if (Session::has('user_created'))
            <div class="d-none flex-column" id="creation">
                <p class="form-label">Email</p>
                <p>{{ Session::get('user_created')[0] }} </p>
                <div class="d-flex align-items-center py-2">
                    <p class="form-label my-0">Contraseña</p>
                    <i id="newPasswordToggler" class="fa-solid fa-eye link-secondary ms-2"></i>
                </div>
                <input id="newPasswordInput" class="border-0 mb-2" type="password" value="{{ Session::get('user_created')[1] }}"
                    disabled>
                <div>
                    <a class="link-secondary fs-6" id="copyPasswordBtn">{{ __("Copy password") }}</a>
                </div>
            </div>
            @vite(['resources/js/userCreated.js'])
        @endif

        @if (Session::has('cantInactivateYourself'))
            @vite(['resources/js/cantInactivateYourself.js'])
        @endif

        <button type="button" id="createUserBtn" class="btn btn-th-primary text-white rounded-0 my-2">Create User</button>

        <form action="{{ route('user.create') }}" class="d-none p-3" method="POST" id="createUserForm">
            @csrf

            <div class="row mb-3">
                <div class="col-12">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror fs-4"
                        name="name" value="{{ old('name') }}" required autocomplete="name" autofocus
                        placeholder="{{ __('Name') }}">

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror fs-4"
                        name="email" value="{{ old('email') }}" required autocomplete="email"
                        placeholder="{{ __('Email') }}">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror fs-4"
                        name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12">
                    <input id="password-confirm" type="password" class="form-control fs-4" name="password_confirmation"
                        required autocomplete="new-password" placeholder="{{ __('Confirm password') }}">
                </div>
            </div>

            <div class="row mb-0">
                <div class="col-12">
                    <button type="submit" class="btn btn-th-primary text-white rounded-0 w-100 fs-4">
                        {{ __('Create') }}<i class="fa-regular fa-pen-to-square ms-2"></i>
                    </button>
                </div>
            </div>
        </form>

        <h2 class="mt-3">{{ __('Users') }}</h2>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th>Updated At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->active == 1)
                                <strong class="text-success">Active</strong>
                            @else
                                <strong class="text-danger">Unactive</strong>
                            @endif
                        </td>
                        <td>{{ $user->created_at }}</td>
                        <td>{{ $user->updated_at }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}"
                                class="btn btn-secondary rounded-0 d-block mb-1">{{ __('Edit') }}</a>
                            @if ($user->active == 1)
                                <form method="POST" action="{{ route('user.delete', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-danger rounded-0 d-block w-100">{{ __('Inactivate') }}</button>
                                </form>
                            @else
                                <form method="POST" action="{{ route('user.reactivate', $user->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="btn btn-success rounded-0 d-block w-100">{{ __('Activate') }}</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-5 text-center">{{ __('No users found.') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection

@section('scripts')
    @vite(['resources/js/createUser.js'])
@endsection
