@extends('layouts.app')

@section('content')

    <a href=" {{ route('category.index') }} ">Back</a>

    <h1>Category</h1>

    <h4> {{ $category->name }} </h4>
    <h5> {{ $category->description }} </h5>


@endsection
