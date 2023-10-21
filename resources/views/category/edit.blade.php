@extends('layouts.app')

@section('content')

    <a href=" {{ route('category.index') }} ">Back</a>
    <form action=" {{ route('category.update', $category->id) }} " method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Category name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $category->name }}">
            <label for="description">Category Description</label>
            <input type="text" name="description" id="description" class="form-control" value="{{ $category->description }}">
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
