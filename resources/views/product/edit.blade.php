@extends('layouts.app')

@section('content')

    <a href=" {{ route('product.index') }} ">Back</a>
    <form action=" {{ route('product.update', $product->id) }} " method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="category">Category</label>
            <select name="category_id" id="category" class="form-control">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </div>
        <br>
        <label for="name">Product Name</label>
        <input type="text" name="name" id="name" class="form-control" value="{{ $product->name }}">
        <br>
        <label for="short_desc">Product Short Description</label>
        <input type="text" name="short_desc" id="short_desc" class="form-control"
               value="{{ $product->short_desc }}">
        <br>
        <label for="long_desc">Product Long Description</label>
        <input type="long_desc" name="long_desc" id="description" class="form-control"
               value="{{ $product->long_desc }}">
        <br>
        <label for="price">Product Price</label>
        <input type="text" name="price" id="price" class="form-control"
               value="{{ $product->price }}">
        <br>
        <label for="main_image">Product Image</label>
        <input type="text" name="main_image" id="main_image" class="form-control"
               value="{{ $product->main_image }}">
        <button type="submit" class="btn btn-primary">Update</button>
    </form>

@endsection
