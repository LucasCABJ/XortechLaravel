@extends('layouts.app')

@section('title', 'Home')

@section('content')

    @component('components.navbar')
    @endcomponent

    @if(session('error'))
        <div id="errorMessage" data-error="{{ session('error') }}"></div>
    @endif

    <!--hero-->
    @include('partials.hero')
    <!--end hero-->

    <section class="container py-lg-5">
        <!-- CATEGORIES -->
        <article class="row py-5">

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="{{ asset('assets/img/monitor.png') }}" alt="Monitors Category"
                             class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Monitors</h3>
                        <a href="#" class="btn btn-th-info text-white rounded-0">Buy</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="{{ asset('assets/img/auris.png') }}" alt="Headphones Category"
                             class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Headphones</h3>
                        <a href="#" class="btn btn-th-info text-white rounded-0">Buy</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="{{ asset('assets/img/mouse1.png') }}" alt="Peripherals Category"
                             class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Mouse</h3>
                        <a href="#" class="btn btn-th-info text-white rounded-0">Buy</a>
                    </div>
                </div>
            </div>

        </article>

        <!-- SPEAKER BANNER -->
        @include('partials.banner')
        <!-- MONITOR BANNER -->
        {{--<article class="row mt-5">
            <div class="col-12 p-0 overflow-hidden monitor-banner">
                <div class="container-fluid">
                    <div class="row p-5 position-relative">
                        <div class="col-lg-6 position-relative">
                            <h3 class="h1 text-white">
                                VIEWSONIC GAMER CURVED MONITOR 27 INCHES XG270QC</h3>
                            <button class="btn btn-outline-light rounded-0 mt-3 p-3">View Product</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>--}}
        <!-- BEST COMPONENTS -->
        <article class="row my-5">
            <div class="col-lg-6 p-5 d-flex flex-column align-items-start justify-content-center">
                <h4 class="text-th-info fs-1 text-uppercase">The <span class="text-th-primary">best</span> components for
                    your games</h4>
                <p class="fs-4">In XorTech you will find the best products available in the market. Everything you need to improve your gaming experience.</p>
            </div>
            <div class="col-lg-6">
                <img src="./assets/img/setupgamer.jpg" alt="Gaming Setup" class="img-fluid rounded">
            </div>
        </article>
    </section>

@endsection

@section('scripts')
    @vite(['resources/js/errorMessage.js'])
@endsection
