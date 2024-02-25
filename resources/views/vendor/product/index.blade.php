@extends('layouts.admin-layout')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">
        <a href="{{ route('vendor.product.create') }}" class="btn btn-primary mb-3">Create Product</a>

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
                            <a href="{{ route('vendor.product.edit', $product->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('vendor.product.destroy', $product->id) }}" method="POST" class="d-inline">
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
