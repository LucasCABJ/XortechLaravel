@extends('layouts.app')

@section('content')

    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">

        <a href="{{ route('category.create') }}" class="btn btn-primary">Create Category</a>

        <h2>Categories</h2>

        @if(count($categories) > 0)
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                  class="d-inline">
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
            <p>No categories found</p>
        @endif
    </div>

@endsection

