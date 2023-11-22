@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent


    <section style="background-color: #eee;">
        <div class="container py-5">
            @foreach($products as $product)
                <div class="row justify-content-center mb-3">
                    <div class="col-md-12 col-xl-10">
                        <div class="card shadow-0 border rounded-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                            @if($product->image->url)
                                                <img src="{{ asset($product->image->url) }}" class="w-100" />
                                            @else
                                                <img src="{{'/images/default-product-image.png'}}" class="w-100" />
                                            @endif
                                            <a href="{{ route('product.show',$product->id) }}">
                                                <div class="hover-overlay">
                                                    <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                                </div>
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
                                            {{--<span class="text-danger"><s>$20.99</s></span>--}}
                                        </div>
                                        <h6 class="text-success">Shipping</h6>
                                        <div class="d-flex flex-column mt-4">
                                            <button class="btn btn-primary btn-sm" type="button">Buy Now</button>
                                            <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <button type="submit" class="btn btn-outline-primary btn-sm mt-2 w-100">
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
        </div>
    </section>

@endsection
