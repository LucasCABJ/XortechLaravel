@extends('layouts.admin-layout')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">
        <a href="{{ route('vendor.category.index') }}" class="btn btn-secondary mb-3">Back</a>

        <div class="row justify-content-center">
            <form action="{{ route('category.store') }}" method="POST" class="col-11">
                @csrf
                <div class="form-group mb-3">
                    <label for="name">Category Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                           value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="description">Category Description</label>
                    <input type="text" name="description" id="description"
                           class="form-control @error('description') is-invalid @enderror"
                           value="{{ old('description') }}" required>
                    @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-th-primary text-light my-3"><i class="fas fa-plus"></i> Create
                </button>
            </form>
        </div>
    </div>
@endsection
