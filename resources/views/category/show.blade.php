@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">
        <a href="{{ route('category.index') }}" class="btn btn-secondary mb-3">Back</a>

        <h1 class="display-4">Category</h1>

        <div class="card">
            <div class="card-body">
                <h3 class="card-title">{{ $category->name }}</h3>
                <p class="card-text">{{ $category->description }}</p>
            </div>
        </div>

        <h2 class="mt-4">Products</h2>

        @if(count($category->products) > 0)
                @foreach($category->products as $product)
                    <div class="row justify-content-center mb-3">
                        <div class="col-md-12 col-xl-10">
                            <div class="card shadow-0 border rounded-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                                <a href="{{ route('product.show',$product->id) }}">
                                                    @if($product->images()->exists())
                                                        <img src="{{ asset($product->images->first()->url) }}" class="w-100" />
                                                    @else
                                                        <img src="{{ asset('/images/default-product-image.png') }}" class="w-100" />
                                                    @endif
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-xl-6">
                                            <h5 class="fs-3">{{ $product->name }}</h5>
                                            <div class="mt-2 mb-0 lead small">
                                                {{ $product->short_desc}}
                                            </div>
                                            <div class="mb-2 mt-2 text-muted small text-truncate">
                                                {{ $product->long_desc }}
                                            </div>

                                        </div>
                                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                                            <div class="d-flex flex-row align-items-center mb-1">
                                                <h4 class="mb-1 me-1">{{ $product->price }}</h4>
                                            </div>
                                            <h6 class="text-success">Free Shipping</h6>
                                            <div class="d-flex flex-column mt-4">
                                                <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <button type="submit" class="btn btn-th-primary text-light mt-5 btn-sm mt-2 w-100">
                                                        Add to cart
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
        @else
            <p class="mt-3">No products found</p>
        @endif
    </div>
@endsection
