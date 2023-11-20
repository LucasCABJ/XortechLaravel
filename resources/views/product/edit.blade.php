@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

    {{-- Breadcrumbs --}}
    <nav class="bg-th-info"
         aria-label="breadcrumb">
        <div class="container py-2">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item active">
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
    {{-- End Breadcrumbs --}}

    <main>
        <h1 class="page-header-title display-6 mt-3 ms-5 text-th-tertiary">{{ $product->name }}</h1>

        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active"
                        id="home-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#details"
                        type="button"
                        role="tab"
                        aria-controls="home"
                        aria-selected="true">Product Details
                </button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link"
                        id="profile-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#images"
                        type="button"
                        role="tab"
                        aria-controls="profile"
                        aria-selected="false">Product Images
                </button>
        </ul>

        {{-- DETAILS TAB --}}
        <div class="tab-content" id="product ">
            <div id="details"
                 class="tab-pane fade show active"
                 role="tabpanel"
                 aria-labelledby="details-tab">
                <form action="{{ route('product.update', $product->id) }}" method="POST">

                    @csrf
                    @method('PUT')
                    <div class="container-fluid p-4">
                        <div class="page-header">
                            <!-- Fila (row) -->
                            <div class="row align-items-center mt-3">
                                <!-- Columna izquierda: y título de la página -->
                                <div class="col-sm mb-2 mb-sm-0 ms-3">
                                    <h3 class="text-th-tertiary">
                                        <i class="fa-solid fa-computer"></i> Product Detail
                                    </h3>
                                </div>
                                <!-- Fin de la columna izquierda -->

                                <!-- Columna derecha: Botones de navegación -->
                                <div class="col-sm-auto">
                                    <button type="submit" class="btn btn-lg btn-th-primary text-white fs-4 me-4">Update</button>
                                </div>
                                <!-- Fin de la columna derecha -->
                            </div>
                            <!-- Fin de la fila (row) -->
                        </div>
                    </div>
                    <!-- Fin de la sección de encabezado de la página -->

                    <!-- ROW PRINCIPAL -->
                    <div class="row px-5">
                        <!-- Columna izquierda -->
                        <div class="col-lg-4">
                            <!-- Card -->
                            <div class="card mb-2 mb-lg-5 border-th-tertiary">
                                <!-- Header -->
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Image</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">
                                    <!-- Form Switch -->
                                    <!-- Sección para mostrar y seleccionar imágenes -->
                                    {{--@dd($product,$product->images)--}}
                                    @if($product->images)
                                        <img class="img-fluid contain  mb-2" src="{{ asset($product->images[0]->url) }}"
                                             alt="">
                                        <div class="row row-cols-3 row-cols-md-4 g-2">
                                            @foreach($product->images as $image)
                                                <div class="mb-3">
                                                    <img class="img-fluid contain rounded-0 col" src="{{ asset($image->url) }}"
                                                         alt="">
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <img class="img-fluid contain shadow mb-2"
                                             src="{{'/images/default-product-image.png'}}"
                                             alt="">
                                        <div class="row row-cols-3 row-cols-md-4 g-2">
                                            <img class="img-fluid contain rounded-0 col"
                                                 src="{{'/images/default-product-image.png'}}"
                                                 alt="">
                                            <img class="img-fluid contain rounded-0 col"
                                                 src="{{'/images/default-product-image.png'}}"
                                                 alt="">
                                            <img class="img-fluid contain rounded-0 col"
                                                 src="{{'/images/default-product-image.png'}}"
                                                 alt="">
                                            <img class="img-fluid contain rounded-0 col"
                                                 src="{{'/images/default-product-image.png'}}"
                                                 alt="">
                                        </div>
                                    @endif
                                    <!-- End Form Switch -->

                                </div>
                                <!-- End Body -->

                            </div>
                            <!-- End Card -->
                        </div>
                        <!-- End Columna izquierda -->
                        <!-- Columna derecha -->
                        <div class="col-lg-5">
                            <!-- Card -->
                            <div class="card mb-2 mb-lg-5 border-th-tertiary mx-3">
                                <!--Card Header -->
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Product Description</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">
                                    <!-- Form -->
                                    <div class="mb-4">
                                        <!-- name #TAG -->
                                        <label for="name" class="form-label">
                                            Name
                                        </label>
                                        <input type="text"
                                               class="form-control @error('name') is-invalid @enderror"
                                               name="name"
                                               id="name"
                                               value="{{ $product->name }}"
                                               required
                                        >
                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                    <!-- short_desc #TAG -->
                                    <div class="mb-4">
                                        <label for="shortDescLabel" class="form-label">
                                            Short Description
                                        </label>
                                        <textarea class="form-control @error('short_desc') is-invalid @enderror"
                                                  name="short_desc"
                                                  id="short_desc"
                                                  rows="2"
                                        >{{ $product->short_desc }}
                                </textarea>
                                        @error('short_desc')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                    <!-- long_desc #TAG -->
                                    <div class="mb-4">
                                        <label for="long_desc"
                                               class="form-label">
                                            Long Description
                                        </label>
                                        <textarea class="form-control @error('long_desc') is-invalid @enderror"
                                                  name="long_desc"
                                                  id="long_desc"
                                                  rows="8"
                                        >{{ $product->long_desc }}
                                </textarea>
                                        @error('short_desc')
                                        <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                        @enderror
                                    </div>

                                </div>
                                <!-- End Body -->
                            </div>
                            <!-- End Card -->

                        </div>
                        <div class="col-lg-3">
                            <!-- Card -->
                            <div class="card mb-2 mb-lg-5 border-th-tertiary mx-3">
                                <!-- Header -->
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Pricing</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">
                                    <div class="mb-4">
                                        <label for="price" class="form-label">Price</label>
                                        <div class="input-group">
                                            <input type="number"
                                                   class="form-control @error('price') is-invalid @enderror"
                                                   name="price"
                                                   id="price"
                                                   value="{{ $product->price }}"
                                            >
                                            @error('price')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <hr class="my-4">

                                    <!-- Form Switch -->
                                    <label class="row form-check form-switch ms-4" for="active">
                                <span class="col-8 col-sm-9 ms-0">
                                    <span class="text-dark">
                                        Available
                                    </span>
                                </span>
                                        <span class="col-4 col-sm-3 text-end">
                                    <input type="checkbox"
                                           class="form-check-input"
                                           id="active"
                                           name="active"
                                           value="1"
                                           {{ $product->active ? 'checked' : '' }}
                                    >
                                </span>
                                    </label>
                                    <!-- End Form Switch -->


                                </div>
                                <!-- Body -->
                            </div>
                            <!-- End Card -->

                            <!-- Card -->
                            <div class="card mb-2 mb-lg-5 border-th-tertiary mx-3">
                                <!-- Header -->
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Brand</h4>
                                </div>
                                <!-- End Header -->

                                <!-- Body -->
                                <div class="card-body">
                                    <!-- Form -->
                                    {{--<div class="mb-4">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text"
                                               class="form-control"
                                               name="brand"
                                               id="brand"
                                               value="Asus"
                                        >
                                    </div>--}}
                                    <!-- End Form -->

                                    <!-- Form -->
                                    <div class="mb-4">
                                        <label for="category"
                                               class="form-label"
                                               id="category">
                                            Category
                                        </label>
                                        <!-- Select -->
                                        <div class="tom-select-custom">
                                            <select class="form-select"
                                                    autocomplete="off"
                                                    id="category"
                                                    name="category_id"
                                            >
                                                @foreach($categories as $category)
                                                    <option
                                                        value="{{ $category->id }}" {{ $category->id === $product->category_id ? 'selected' : '' }}>
                                                        {{ $category->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- End Select -->
                                    </div>
                                    <!-- End Form -->
                                </div>
                                <!-- End Body -->
                            </div>
                            <!-- End Card -->
                        </div>
                    </div>
                    <!-- END ROW PRINCIPAL -->
                </form>
            </div>
        </div>
        {{-- END DETAILS TAB --}}

        {{-- IMAGES TAB --}}
        <div id="images"
             class="tab-pane fade"
             role="tabpanel"
             aria-labelledby="details-tab">
            <div class="container-fluid p-4">
                <!-- Form -->
                <form action="{{ route('product.storeImages', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                   {{-- @method('PUT')--}}
                    {{-- Page Header --}}
                    <div class="page-header mb-4">
                        <div class="row align-items-center mt-3">
                            <!-- Columna izquierda: y título de la página -->
                            <div class="col-sm mb-2 mb-sm-0 ms-3 text-th-tertiary">
                                <h3>
                                    <i class="fa-solid fa-images"></i> Product Images
                                </h3>
                            </div>
                            <!-- Columna derecha: Botones de navegación -->
                            <div class="col-sm-auto">
                                <button type="submit"
                                        id="submit-product-images"
                                        class="btn btn-lg btn-th-primary text-white fs-4 me-4">Update</button>
                            </div>
                            <!-- Fin de la columna derecha -->
                        </div>
                    </div>
                    {{-- End Page Header--}}
                    <div class="row">
                        <div class="col-lg-8">

                            <div class="card mb-2 mb-lg-5 border-th-tertiary mx-3">
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Arrange Image Order</h4>
                                </div>
                                <div class="card-body">

                                    <ul id="image-list-product" class="row row-cols-3 row-cols-md-6 row-cols-lg-8 g-2 gallery">
                                        @forelse($product->images as $image)
                                            <li id="image_{{ $image->id }}" class="rounded-0 col">
                                                <img class="img-fluid contain"
                                                     src="{{ asset($image->url) }}"
                                                     alt="image_{{ $image->id }}"
                                                     style="width:200px; height:200px;">
                                            </li>
                                        @empty
                                            <p>No images</p>
                                        @endforelse
                                    </ul>


                                </div>
                            </div>
                        </div>
                        <div class="col lg-4">

                            <div class="card mb-2 mb-lg-5 border-th-tertiary mx-3">
                                <!-- Header -->
                                <div class="card-header text-bg-th-info">
                                    <h4 class="card-header-title">Load Images</h4>
                                </div>
                                <!-- End Header -->
                                <!-- Body -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="input-group mb-3">
                                                <input type="file"
                                                       class="form-control"
                                                       id="inputGroupFile"
                                                       name="images[]"
                                                       multiple
                                                       accept="image/*"
                                                       aria-label="Upload"
                                                       aria-describedby="button-addon2">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        {{-- END IMAGES TAB --}}


    </main>

@endsection
{{--@section('scripts')--}}
{{--    @vite(['resources/js/image-sorter.js'])--}}
{{--@endsection--}}
