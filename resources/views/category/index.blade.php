@extends('layouts.app')

@section('content')
    <a href=" {{ route('category.create') }} ">Create Category</a> | <a href=" {{ route('product.index') }} ">Products</a>
    <ul>
        @forelse( $categories as $category)
            <li>
                <a href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a> |
                <a href=" {{ route('category.edit',$category->id) }} ">EDIT</a> |
                <form action=" {{ route('category.destroy', $category->id) }} " method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">DELETE</button>
                </form>
            </li>
            @empty
            <li>No categories found</li>
        @endforelse
    </ul>
@endsection
