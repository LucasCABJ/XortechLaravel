@extends('layouts.app')

@section('title', 'Users')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4" style="min-height: 80vh">

        <a href="{{ route('category.create') }}" class="btn btn-th-primary text-white rounded-0 my-2">Create User</a>

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
    </div>
@endsection
