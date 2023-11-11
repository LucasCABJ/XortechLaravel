@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">
        <a href="{{ route('product.create') }}" class="btn btn-primary mb-3">Create Product</a>

        <h2>Products</h2>

        @if(count($products) > 0)
            <table class="table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>
                            <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                        </td>
                        <td>
                            <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-outline-primary">Add to cart</button>
                            </form>
                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('product.destroy', $product->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <p>No products found</p>
        @endif
    </div>
@endsection
