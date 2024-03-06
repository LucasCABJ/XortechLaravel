@extends('layouts.app')

@section('content')

    @component('components.navbar')
    @endcomponent

    <div class="container mt-4">

        <!-- CATEGORIES -->
        <article class="row py-5">

            @foreach($categories as $category)
            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="{{ asset($category->image) }}" alt="Category Image"
                             class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">{{ $category->name }}</h3>
                        <a href="{{ route('category.show', $category->id) }}" class="btn btn-th-info text-white rounded-0">Go</a>
                    </div>
                </div>
            </div>
            @endforeach
        </article>
    </div>

@endsection

