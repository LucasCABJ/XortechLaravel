@extends('layouts.app')

@section('title', 'Home')

@section('content')

@component('components.navbar')
@endcomponent

    <!--hero-->

    <div class="container-fluid bg-customdark hero p-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 d-flex flex-column justify-content-start align-items-start p-5">
                    <h3 class="new-product text-start">
                        Nuevo Producto
                    </h3>
                    <h2 class="text-light product-title text-lg-start my-3">ASUS ROG Swift PG32UQXR</h2>
                    <p class="description h5 text-light text-start">
                        La mejor imagen para tus juegos, con la mejor tasa de refresco y resolución.
                    </p>
                    <button class="btn btn-theme-magenta text-white rounded-0 mt-4 p-3">Comprar ahora</button>
                </div>
                <div class="col-lg-6 d-flex justify-content-center align-items-center">
                    <img src="assets/img/heroMonitor.png" alt="Monitor"
                        style="width: 90%; max-height: 100%; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
    </div>
    <!--fin hero-->

    <section class="container py-lg-5">
        <!-- CATEGORIAS -->
        <article class="row py-5">

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="./assets/img/191800-1200-auto.png" alt="Monitores Categoria"
                            class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Monitores</h3>
                        <a href="#" class="btn btn-theme-lila text-white rounded-0">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="./assets/img/auris.png" alt="Auriculares Categoria" class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Auriculares</h3>
                        <a href="#" class="btn btn-theme-lila text-white rounded-0">Comprar</a>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 mt-5 mb-4">
                <div class="d-flex flex-column align-items-center rounded-2 position-relative tarjeta">
                    <div class="img-container position-absolute bottom-50" style="max-width: 200px;">
                        <img src="./assets/img/mouse1.png" alt="Perifericos Categoria" class="img-fluid tarjeta-img">
                    </div>
                    <div class="text-center rounded-2 pt-5 pb-4 w-100 tarjeta-descripcion">
                        <h3 class="mb-4 mt-5 pt-5">Perifericos</h3>
                        <a href="#" class="btn btn-theme-lila text-white rounded-0">Comprar</a>
                    </div>
                </div>
            </div>

        </article>
        <!-- BANNER PARLANTE -->
        <article class="row">
            <div class="col-12 p-0 overflow-hidden" style="background-color: #7d62a0;">
                <div class="container-fluid">
                    <div class="row p-5 position-relative parlante__container">
                        <div class="parlante__circulo"
                            style="max-height: 500px; height: 500px; max-width: 500px; width: 500px;"></div>
                        <div class="parlante__circulo"
                            style="max-height:500px; height: 350px; max-width: 350px; width: 350px;"></div>
                        <div class="parlante__circulo"
                            style="max-height: 1000px; max-width: 1000px; height: 1000px; width: 1000px"></div>
                        <div class="parlante__circulo2"
                            style="max-height: 500px; height: 500px; max-width: 500px; width: 500px;"></div>
                        <div class="parlante__circulo2"
                            style="max-height: 750px; height: 750px; max-width: 750px; width: 750px;"></div>
                        <div class="col-lg-6 position-relative">
                            <img src="assets/img/jbl.png" class="img-fluid parlante__img" alt="Parlante JBL">
                        </div>
                        <div class="col-lg-6 text-white p-5 d-flex flex-column justify-content-center align-items-start">
                            <h3 class="h1">
                                PARLANTE JBL FLIP XTREME 3 BLUETOOTH BLACK</h3>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eligendi commodi, debitis,
                                corporis voluptatibus reprehenderit quisquam non fugit rerum enim cum architecto
                                pariatur reiciendis iste sit et suscipit natus maxime itaque?</p>
                            <button class="btn btn-outline-light rounded-0 p-3">Ver Producto</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <!-- BANNER MONITOR -->
        <article class="row mt-5">
            <div class="col-12 p-0 overflow-hidden monitor-banner">
                <div class="container-fluid">
                    <div class="row p-5 position-relative">
                        <div class="col-lg-6 position-relative">
                            <h3 class="h1 text-white">
                                VIEWSONIC MONITOR CURVER GAMER 27 PULGADAS XG270QC</h3>
                            <button class="btn btn-outline-light rounded-0 mt-3 p-3">Ver Producto</button>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <!-- LOS MEJORES COMPONENTES -->
        <article class="row mt-5">
            <div class="col-lg-6 p-5 d-flex flex-column align-items-start justify-content-center">
                <h4 class="text-theme-lila h2">Los <span class="text-theme-magenta">mejores</span> componentes para
                    tus juegos</h4>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nihil placeat expedita animi odio?
                    Blanditiis ad necessitatibus aliquam libero vel fugit. Id nemo fugit fuga maiores ad. Cumque aliquid
                    fugit maiores!</p>
            </div>
            <div class="col-lg-6">
                <img src="./assets/img/setupgamer.jpg" alt="Gaming Setup" class="img-fluid rounded">
            </div>
        </article>
    </section>

    <footer class="bg-theme-violeta mt-5">
        <div class="row justify-content-between">
            <div class="col-12 col-lg-6 order-lg-2 navbar navbar-expand-sm ps-4 justify-content-sm-center">
                <ul class="navbar-nav pt-3 pt-lg-1">
                    <li class="nav-item">
                        <a class="navLink " aria-current="page" href="#">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="navLink " href="#">CATEGORIAS</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="navLink " href="pages/productos.html">PRODUCTOS</a>

                    </li>
                    <li class="nav-item">
                        <a class="navLink" href="assets/PDF/E-Commerce.pdf" target="_blank">MAQUETA</a>
                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-6 order-lg-1 p-4 justify-content-center">
                <div class="container p-4 text-center">
                    <p class="text-light ps-4">
                        Vení a XORTECH y llevate los mejores componentes.<br>
                        La "X" marca el lugar.
                    </p>
                </div>
            </div>
        </div>

    </footer>

@endsection
