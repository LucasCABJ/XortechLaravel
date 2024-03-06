@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent


    <section style="background-color: #eee;">
        <div class="container py-5">
            <form action="{{ route('product.index') }}">
                <div class="row justify-content-center mb-3">
                    <div class="col-10">
                        <div class="input-group">
                            <input type="text" class="form-control" name="search" placeholder="Search products" value="{{ request('search') }}">
                            <button class="btn btn-th-info text-light me-2" type="submit">Search</button>
                            <a href="{{ route('product.index') }}" class="btn btn-outline-th-primary ms-2">Clear</a>
                        </div>
                    </div>

                </div>
            </form>
            @foreach($products as $product)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                        <div class="card shadow-0 border rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            <a href="{{ route('product.show',$product->id) }}">
                                                @if($product->image && $product->image->url)
                                                    <img src="{{ asset($product->image->url) }}" class="w-100" />
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
            {{ $products->links() }}
        </div>
    </section>

@endsection
