@extends('layouts.app')

@section('content')
    <a href=" {{ route('category.index') }} ">Back</a>
    <form action=" {{ route('category.store') }} " method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Category name</label>
            <input type="text" name="name" id="name" class="form-control">
            <label for="description">Category Description</label>
            <input type="text" name="description" id="description" class="form-control">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection
