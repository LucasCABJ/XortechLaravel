@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent
    <!-- Breadcrumb -->
    <nav class="bg-th-info"
        style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
        <div class="container py-2">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-white-50">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('category.index') }}" class="text-white-50">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('category.show', $product->category) }}" class="text-white"><u>{{ $product->category->name }}</u></a></li>
            </ol>
        </div>
    </nav>

    <!-- Breadcrumb -->

    <!-- content -->
    <section class="py-4 bg-secondary-subtle">
        <div class="container shadow bg-light rounded-3 p-3">
            <div class="row gx-5">
                <div class="col-lg-6">
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <!-- Carousel Slides -->
                        <div class="carousel-inner bg-th-info rounded-2">
                            <!-- Slide 1 -->
                            <div class="carousel-item active img-container">
                                <div data-bs-toggle="lightbox" data-bs-slide-to="0" class="">
                                    <img src="https://redragon.es/content/uploads/2021/04/CETROPHORUS-RGB.png"
                                         class="img-fluid img-cover rounded mx-auto" alt="Image 1">
                                </div>
                            </div>
                            <!-- Slide 2 -->
                            <div class="carousel-item img-container">
                                <div data-bs-toggle="lightbox" data-bs-slide-to="1">
                                    <img
                                        src="https://www.infinitonline.com.ar/images/000000000000128288000aquila-fly-black-matte-11-d5e03a8e6b5b7f2c0f16527437443635-1024-1024--1-.png"
                                        class="img-fluid img-cover rounded mx-auto" alt="Image 2">
                                </div>
                            </div>
                        </div>
                        <!-- Carousel Slides -->

                        <!-- Thumbnails -->
                        <div class="d-flex justify-content-center mt-3">
                            <!-- Thumbnail 1 -->
                            <a data-bs-target="#carouselExample" data-bs-slide-to="0" class="border mx-1 rounded-2"
                               href="#">
                                <img width="60" height="60" class="rounded-2"
                                     src="https://redragon.es/content/uploads/2021/04/CETROPHORUS-RGB.png"
                                     alt="Thumbnail 1">
                            </a>
                            <!-- Thumbnail 2 -->
                            <a data-bs-target="#carouselExample" data-bs-slide-to="1" class="border mx-1 rounded-2"
                               href="#">
                                <img width="60" height="60" class="rounded-2"
                                     src="https://www.infinitonline.com.ar/images/000000000000128288000aquila-fly-black-matte-11-d5e03a8e6b5b7f2c0f16527437443635-1024-1024--1-.png"
                                     alt="Thumbnail 2">
                            </a>
                        </div>
                        <!-- Thumbnails -->
                    </div>
                    {{--Version con imagenes en storage--}}
                    {{--<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner bg-th-info rounded-2">
                            @foreach($imagenes as $imagen)
                                <div class="carousel-item{{ $loop->first ? ' active' : '' }} img-container">
                                    <div data-bs-toggle="lightbox" data-bs-slide-to="{{ $loop->index }}">
                                        <img src="{{ $imagen->ruta }}" class="img-fluid img-cover rounded mx-auto" alt="Image {{ $loop->iteration }}">
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Thumbnails -->
                        <div class="d-flex justify-content-center mt-3">
                            @foreach($imagenes as $imagen)
                                <a data-bs-target="#carouselExample" data-bs-slide-to="{{ $loop->index }}" class="border mx-1 rounded-2" href="#">
                                    <img width="60" height="60" class="rounded-2" src="{{ $imagen->ruta }}" alt="Thumbnail {{ $loop->iteration }}">
                                </a>
                            @endforeach
                        </div>
                        <!-- Thumbnails -->
                    </div>--}}


                </div>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ $product->name }}
                        </h4>
                        <div class="d-flex flex-row my-3">
                            {{--<div class="text-warning mb-1 me-2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                                <span class="ms-1">
                                    4.5
                                </span>
                            </div>
                            <span class="text-muted"><i class="fas fa-shopping-basket fa-sm mx-1"></i>154 orders</span>
                            <span class="text-success ms-2">In stock</span>--}}
                        </div>

                        <div class="mb-3">
                            <span class="h5">${{ $product->price }}</span>
                            {{--<span class="text-muted">/per box</span>--}}
                        </div>

                        <p>
                            {{ $product->long_desc }}
                        </p>

                        {{--<div class="row">
                            <dt class="col-3">Type:</dt>
                            <dd class="col-9">Regular</dd>

                            <dt class="col-3">Color</dt>
                            <dd class="col-9">Brown</dd>

                            <dt class="col-3">Material</dt>
                            <dd class="col-9">Cotton, Jeans</dd>

                            <dt class="col-3">Brand</dt>
                            <dd class="col-9">Reebook</dd>
                        </div>--}}

                        <hr/>

                        <div class="row mb-4">
                            {{--<div class="col-md-4 col-6">
                                <label class="mb-2">Size</label>
                                <select class="form-select border border-secondary" style="height: 35px;">
                                    <option>Small</option>
                                    <option>Medium</option>
                                    <option>Large</option>
                                </select>
                            </div>--}}
                            <!-- col.// -->
                            <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="">
                                @csrf
                                <input type="hidden" name="id" value="{{ $product->id }}">
                                <div class="col-md-4 col-6 mb-3">
                                <label class="mb-2 d-block">Quantity</label>
                                <div class="input-group input-group-sm mb-3" style="width: 140px;">
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="decrement" data-mdb-ripple-color="dark">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <input type="text"
                                           name="quantity"
                                           class="form-control text-center border border-secondary"
                                           value="1"
                                           aria-label="Example text with button addon"
                                           aria-describedby="button-addon1"
                                           id="quantity" />
                                    <button class="btn btn-white border border-secondary px-3" type="button" id="increment" data-mdb-ripple-color="dark">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <a href="#" class="btn btn-warning shadow-0 disabled"> Buy now </a>
{{--                        <form action="{{ route('shoppingCart.addProduct') }}" method="POST" class="d-inline">--}}
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="btn btn-primary"><i class="me-1 fa fa-shopping-basket"></i> Add to cart</button>
                        </form>
                        {{--<a href="#" class="btn btn-light border border-secondary py-2 icon-hover px-3"> <i
                                class="me-1 fa fa-heart fa-lg"></i> Save </a>--}}
                    </div>
                </main>
            </div>
        </div>
    </section>
    <!-- content -->
@endsection
