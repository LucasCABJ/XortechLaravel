@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">
        <a href="{{ route('category.show', $product->category) }}" class="btn btn-secondary mb-2">
            <i class="fas fa-arrow-left"></i> Back to {{ $product->category->name }}
        </a>
        <a href="{{ route('product.index') }}" class="btn btn-secondary mb-2">
            <i class="fas fa-arrow-left"></i> Back to Products
        </a>

        <h1>{{ $product->name }}</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $product->short_desc }}</h3>
                <p class="card-text">{{ $product->long_desc }}</p>
                <p class="card-text"><strong>Price:</strong> ${{ $product->price }}</p>
                <img src="{{ $product->main_image }}" alt="{{ $product->name }}" class="img-fluid">
            </div>
        </div>
    </div>
@endsection
