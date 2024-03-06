@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent
    <section class="h-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12">
                    <div class="card card-registration card-registration-2" style="border-radius: 15px;">
                        <div class="card-body p-0">
                            <div class="row g-0">
                                <div class="col-lg-9">
                                    <div class="p-5">
                                        <div class="d-flex justify-content-between align-items-center mb-5">
                                            <h1 class="fw-bld mb-0 text-black">Shopping Cart</h1>
                                            <h6 class="mb-0 text-muted">{{ $shoppingCart->count() }} items</h6>
                                        </div>
                                        <hr class="my-4">

                                        {{--products--}}
                                        @php
                                            $total = 0;
                                        @endphp
                                        @foreach($shoppingCart as $item)
                                            @php
                                                $total += $item->subtotal();
                                            @endphp
                                            <div class="row mb-4 d-flex justify-content-between align-items-center">
                                                @if($item->product->images->isNotEmpty())
                                                    <img src="{{ asset($item->product->images->first()->url) }}" class="img-fluid contain w-25 rounded-3" alt="product image">
                                                @else
                                                    <div class="col-md-2 col-lg-2 col-xl-2">
                                                    <img src="https://redragon.es/content/uploads/2021/04/CETROPHORUS-RGB.png"
                                                        class="img-fluid rounded-3" alt="product image">
                                                </div>
                                                @endif
                                                <div class="col-md-3 col-lg-3 col-xl-3">
                                                    <h6 class="text-black">{{ $item->product->name }}</h6>
                                                    <h6 class="text-muted mb-0">{{ $item->product->short_desc }}</h6>
                                                </div>
                                                <div class="col-md-3 col-lg-3 col-xl-2 d-flex">
                                                    <div class="input-group input-group-sm">
                                                        <form
                                                            action="{{ route('shoppingCart.decreaseQuantity', $item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-outline-th-tertiary btn-sm px-2"
                                                                    type="submit" id="decrement">
                                                                <i class="fa-regular fa-minus"></i>
                                                            </button>
                                                        </form>
                                                        <input type="text" class="text-center qty" disabled
                                                               value="{{ $item->quantity }}"
                                                               aria-label="Quantity"
                                                               aria-describedby="button-addon1">
                                                        <form
                                                            action="{{ route('shoppingCart.increaseQuantity',$item->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button class="btn btn-outline-th-tertiary btn-sm px-2"
                                                                        type="submit"
                                                             id="increment">
                                                            <i class="fa-regular fa-plus"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                                                    <h6 class="text-center">{{ $item->quantity }} x
                                                        ${{ $item->product->price }}</h6>
                                                    <h6 class="text-center mb-0">
                                                        $ {{ number_format($item->subtotal(), 2, '.', ',') }}
                                                    </h6>
                                                </div>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <form
                                                        action="{{ route('shoppingCart.deleteProduct', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-danger"><i
                                                                class="fas fa-times"></i></button>
                                                    </form>
                                                </div>
                                            </div>

                                            <hr class="my-4">
                                        @endforeach
                                        <div class="pt-5 d-flex justify-content-between">
                                            <h6 class="mb-0"><a href="{{ route('home.index') }}"
                                                                class="text-body"><i
                                                        class="fas fa-long-arrow-alt-left me-2"></i>Back to
                                                    shop</a></h6>
                                            <form action="{{ route('shoppingCart.emptyCart') }}" method="POST"
                                                  class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Empty Cart" class="btn btn-danger">
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{--summary--}}
                                <div class="col-lg-3 bg-grey">
                                    <div class="p-5">
                                        <h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>
                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase">{{ $shoppingCart->count() }} items</h5>
                                            <h5>${{ $total }}</h5>
                                        </div>

                                        <div class="d-flex justify-content-between mb-4">
                                            <h5 class="text-uppercase mb-3">Shipping</h5>
                                            <h5>${{ $shipping = 0.00 }}</h5>
                                        </div>


                                        <hr class="my-4">

                                        <div class="d-flex justify-content-between mb-5">
                                            <h5 class="text-uppercase">Total price</h5>
                                            <h5>${{ $total + $shipping }}</h5>
                                        </div>

                                        <form action="{{ route('checkout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Check Out</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
