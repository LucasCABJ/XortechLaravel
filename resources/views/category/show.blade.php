@extends('layouts.app')

@section('content')

    <a href=" {{ route('category.index') }} ">Back</a>

    <h1>Category</h1>

    <h3> {{ $category->name }} </h3>
    <h5> {{ $category->description }} </h5>

    <ul>
        @forelse($category->products as $product)
            <li>
                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
            @empty
            <li>No products found</li>
        @endforelse
    </ul>


@endsection
