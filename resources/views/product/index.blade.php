@extends('layouts.app')

@section('content')
    <a href=" {{ route('product.create') }} ">Create Product</a>
    <ul>
        @forelse( $products as $product)
            <li>
                <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a> |
                <a href=" {{ route('product.edit',$product->id) }} ">EDIT</a> |
                <form action=" {{ route('product.destroy', $product->id) }} " method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </li>
        @empty
            <li>No Products found</li>
        @endforelse
    </ul>
@endsection
