@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent
    <!-- Breadcrumb -->
    <nav class="bg-th-info"
         aria-label="breadcrumb">
        <div class="container py-2">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}" class="text-white-50">Category</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    <a href="{{ route('category.show', $product->category) }}"
                        class="text-white-50"><u>{{ $product->category->name }}</u>
                    </a>
                </li>
                <li class="breadcrumb-item text-light">
                    Product Detail
                </li>
            </ol>
        </div>
    </nav>

    <!-- Breadcrumb -->

    <!-- content -->
    <section class="">
        <div class="container py-5">
            <div class="row gx-5 justify-content-around">
                <div class="col-lg-6">

                    {{--Version con imagenes en storage--}}
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-th-info rounded-2">
                            @foreach($product->images as $image)
                                <div class="carousel-item{{ $loop->first ? ' active' : '' }} img-container">
                                    <div data-bs-toggle="lightbox" data-bs-slide-to="{{ $loop->index }}">
                                        <img src="{{ asset($image->url) }}" class="img-fluid img-cover rounded mx-auto" alt="Image {{ $loop->iteration }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Thumbnails -->
                        <div class="d-flex justify-content-center mt-3">
                            @foreach($product->images as $image)
                                <a data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="border mx-1 rounded-2" href="#">
                                    <img width="60" height="60" class="rounded-2" src="{{ asset($image->url) }}" alt="Thumbnail {{ $loop->iteration }}">
                                </a>
                            @endforeach
                        </div>
                        <!-- Thumbnails -->
                    </div>


                </div>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ $product->name }}
                        </h4>
                        <div class="d-flex flex-row my-3">

                        </div>

                        <div class="mb-3">
                            <span class="h5">${{ $product->price }}</span>
                            {{--<span class="text-muted">/per box</span>--}}
                        </div>

                        <p>
                            {{ $product->long_desc }}
                        </p>

                        <hr/>
                        <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="">
                            @csrf
                            <div class="row mb-4">
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="col-md-4 col-6 mb-3">
                                    <label class="mb-2 d-block">Quantity</label>
                                    <div class="input-group input-group-sm mb-3" style="width: 140px;">
                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                                id="decrement" data-mdb-ripple-color="dark">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <input type="text"
                                               name="quantity"
                                               class="form-control text-center border border-secondary"
                                               value="1"
                                               aria-label="Example text with button addon"
                                               aria-describedby="button-addon1"
                                               id="quantity"/>
                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                                id="increment" data-mdb-ripple-color="dark">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
{{--                            <a href="#" class="btn btn-warning shadow-0 disabled"> Buy now </a>--}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary"><i class="me-1 fa fa-shopping-basket"></i> Add
                                to cart
                            </button>
                        </form>

                    </div>
                </main>
            </div>
        </div>
    </section>
    <!-- content -->
@endsection
