@extends('layouts.app')

@section('content')

    <a href=" {{ route('product.index') }} ">Back</a>
    <form action=" {{ route('product.store') }} " method="POST">
        @csrf
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            <br>
            <label for="name">Product name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
            <br>
            <label for="short_desc">Product Short Description</label>
            <input type="text" name="short_desc" id="short_desc" class="form-control" value="{{ old('short_desc') }}">
            <br>
            <label for="long_desc">Product Long Description</label>
            <input type="text" name="long_desc" id="long_desc" class="form-control" value="{{ old('long_desc') }}">
            <br>
            <label for="price">Product Price</label>
            <input type="text" name="price" id="price" class="form-control" value="{{ old('price') }}">
            <br>
            <label for="main_image">Product Image</label>
            <input type="text" name="main_image" id="main_image" class="form-control" value="{{ old('main_image') }}">
        </div>
        <button type="submit" class="btn btn-primary">Create</button>
    </form>

@endsection
