@extends('layouts.admin-layout')

@section('content')

    @component('components.navbar')
    @endcomponent

    <div class="container my-4">

        <a href="{{ route('category.create') }}" class="btn btn-th-primary text-light mb-3 ms-2"><i class="fas fa-plus"></i> Create Category</a>

        <h2 class="ms-2">Categories</h2>

        @if(count($categories) > 0)
            <table class="table mt-3">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('category.show', $category->id) }}" class="btn btn-th-info me-2"><i class="fas fa-eye"></i> View</a>
                            <a href="{{ route('category.edit', $category->id) }}" class="btn btn-outline-warning text-warning-emphasis"><i class="fas fa-edit"></i> Edit</a>
                            {{--<form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>--}}
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

