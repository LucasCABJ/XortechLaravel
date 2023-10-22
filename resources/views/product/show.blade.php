@extends('layouts.app')

@section('content')

    <a href="{{ route('category.show',$product->category) }}">Back to {{ $product->category->name }}</a> |
    <a href="{{ route('product.index') }}">Back to Products</a>

    <h1>{{ $product->name }}</h1>

    <h3>{{ $product->short_desc }}</h3>
    <h5>{{ $product->long_desc }}</h5>
    <h5>{{ $product->price }}</h5>
    <h5>{{ $product->main_image }}</h5>
@endsection
