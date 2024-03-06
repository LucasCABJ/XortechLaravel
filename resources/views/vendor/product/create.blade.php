@extends('layouts.admin-layout')

@section('content')
    {{--@component('components.navbar')
    @endcomponent--}}

    <div class="container mt-4">
        <a href="{{ route('vendor.product.index') }}" class="btn btn-secondary mb-3">Back</a>

        <h2>Create Product</h2>

        <div class="row justify-content-center">
            <form action="{{ route('vendor.product.store') }}" method="POST" class="col-11">
                @csrf
                <div class="form-group mb-3">
                    <label for="category">Category</label>
                    <select name="category_id" id="category" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="short_desc">Product Short Description</label>
                    <input type="text" name="short_desc" id="short_desc" class="form-control @error('short_desc') is-invalid @enderror" value="{{ old('short_desc') }}" required>
                    @error('short_desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="long_desc">Product Long Description</label>
                    <input type="text" name="long_desc" id="long_desc" class="form-control @error('long_desc') is-invalid @enderror" value="{{ old('long_desc') }}" required>
                    @error('long_desc')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="price">Product Price</label>
                    <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                    @error('price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                {{--<div class="form-group">
                    <label for="main_image">Product Image</label>
                    <input type="text" name="main_image" id="main_image" class="form-control @error('main_image') is-invalid @enderror" value="{{ old('main_image') }}" required>
                    @error('main_image')
                    <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>--}}

                <button type="submit" class="btn btn-th-primary text-light my-3"><i class="fas fa-plus"></i> Create</button>
            </form>
        </div>

    </div>
@endsection
