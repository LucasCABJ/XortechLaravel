@extends('layouts.app')

@section('content')
    @component('components.navbar')
    @endcomponent

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

    <main>
        <form action="{{ route('product.update', $product->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="container-fluid p-4">
                <div class="page-header">
                    <div class="row align-items-center mt-3">
                        <!-- Columna izquierda: y título de la página -->
                        <div class="col-sm mb-2 mb-sm-0 ms-3">

                            <!-- Título de la página -->
                            <h1 class="page-header-title display-6">{{ $product->name }}</h1>

                            <!-- Enlaces adicionales -->
                            <div class="mt-2">
                                <a class="text-body me-3" href="#">
                                    <i class="fas fa-clone me-1"></i> Duplicate
                                </a>
                                <a class="text-body" href="#">
                                    <i class="fas fa-eye me-1"></i> Preview
                                </a>
                            </div>
                        </div>
                        <!-- Fin de la columna izquierda -->

                        <!-- Columna derecha: Botones de navegación -->
                        <div class="col-sm-auto">
                            <button type="submit" class="btn btn-lg btn-primary me-4">Update</button>
                        </div>
                        <!-- Fin de la columna derecha -->
                    </div>
                    <!-- Fin de la fila (row) -->
                </div>
            </div>
            <!-- Fin de la sección de encabezado de la página -->

            <div class="row px-5">
                <div class="col-lg-4">
                    <!-- Card -->
                    <div class="card mb-2 mb-lg-5">
                        <!-- Header -->
                        <div class="card-header">
                            <h4 class="card-header-title">Product Images</h4>
                        </div>
                        <!-- End Header -->

                        <!-- Body -->
                        <div class="card-body">
                            <!-- Form Switch -->
                            <!-- Sección para mostrar y seleccionar imágenes -->
                            @if($product->images)
                                @foreach($product->images as $image)
                                    <div class="mb-3">
                                        <label for="delete_image_{{ $image->id }}" class="form-label">Delete
                                            Image: {{ $image->url }}</label>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input"
                                                   id="delete_image_{{ $image->id }}" name="delete_image[]"
                                                   value="{{ $image->id }}">
                                            <label class="form-check-label"
                                                   for="delete_image_{{ $image->id }}">Delete</label>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <img class="img-fluid shadow mb-2" src="https://rakanonline.com/wp-content/uploads/2022/08/default-product-image.png"
                                     alt="">
                                <div class="row row-cols-3 row-cols-md-4 g-1">
                                    <img class="img-fluid col"
                                         src="https://rakanonline.com/wp-content/uploads/2022/08/default-product-image.png"
                                         alt="">
                                    <img class="img-fluid col"
                                         src="https://rakanonline.com/wp-content/uploads/2022/08/default-product-image.png"
                                         alt="">
                                    <img class="img-fluid col"
                                         src="https://rakanonline.com/wp-content/uploads/2022/08/default-product-image.png"
                                         alt="">
                                    <img class="img-fluid col"
                                         src="https://rakanonline.com/wp-content/uploads/2022/08/default-product-image.png"
                                         alt="">
                                </div>
                            @endif
                            <!-- End Form Switch -->

                        </div>
                        <!-- End Body -->

                    </div>
                    <!-- End Card -->
                </div>
                <div class="col-lg-5">
                    <!-- Card -->
                    <div class="card mb-3 mb-lg-5">
                        <!--Card Header -->
                        <div class="card-header">
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
                    <div class="card mb-3 mb-lg-5">
                        <!-- Header -->
                        <div class="card-header">
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
                    <div class="card mb-5">
                        <!-- Header -->
                        <div class="card-header">
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
            {{--<button type="submit" class="btn btn-primary">Update</button>--}}
        </form>

        {{--<form action="{{ route('product.update', $product->id) }}" method="POST" class="m-4 p-4">
            @csrf
            @method('PUT')

            --}}{{-- NAME --}}{{--
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
            --}}{{-- END NAME --}}{{--

            --}}{{-- SHORT DESCRIPTION --}}{{--
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
            --}}{{-- END SHORT DESCRIPTION --}}{{--

            --}}{{-- LONG DESCRIPTION --}}{{--
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
            --}}{{-- END LONG DESCRIPTION --}}{{--

            --}}{{-- PRICE --}}{{--
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
            --}}{{-- END PRICE --}}{{--

            --}}{{-- IS AVAILABLE --}}{{--
            <label class="row form-check form-switch ms-4" for="active">
                            <span class="col-8 col-sm-9 ms-0">
                                <span class="text-dark">
                                    Is Available
                                </span>
                            </span>
                <span class="col-4 col-sm-3 text-end">
                                <input type="checkbox"
                                       class="form-check-input"
                                       id="active"
                                       name="active"
                                       {{ $product->active ? 'checked' : '' }}>
                            </span>
            </label>
            --}}{{-- END IS AVAILABLE --}}{{--

            --}}{{-- CATEGORY --}}{{--
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
            --}}{{-- END CATEGORY --}}{{--

            <div class="col-sm-auto">
                <button type="submit" class="btn btn-lg btn-primary me-4">Update</button>
            </div>

        </form>--}}
    </main>

@endsection
