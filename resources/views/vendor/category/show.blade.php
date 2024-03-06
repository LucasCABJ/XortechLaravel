@extends('layouts.admin-layout')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container my-4">
        <a href="{{ route('category.index') }}" class="btn btn-secondary mb-3">Back</a>

        <h1 class="display-4">Category</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $category->name }}</h3>
                <p class="card-text">{{ $category->description }}</p>
            </div>
        </div>

        <h2 class="mt-4">Products</h2>

        @if(count($category->products) > 0)
            <ul class="list-group">
                @foreach($category->products as $product)
                    <li class="list-group-item">
                        <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="mt-3">No products found</p>
        @endif
    </div>
@endsection
