<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} | @yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts and SCSS -->
    @vite([
        'resources/sass/app.scss',
        'resources/fontawesome/css/all.min.css',
        'resources/js/app.js',
        'resources/js/jquery-3.7.1.js',
        'resources/css/app.css',
        'resources/css/navbar.css',
        'resources/css/bg-striped.css',
        'resources/css/admin.css',
        'resources/css/cart.css',
        'resources/js/quantity-input-handler.js',
        'resources/js/bootstrap.js'
        ])

    @yield('headextra')
</head>
@yield('modals')

<body>
<div id="app">
    @yield('content')
    @component('components.footer')
    @endcomponent
</div>

<!--Offcanvas-->
<div class="offcanvas offcanvas-start show" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
     id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
    <div class="offcanvas-header pb-1">
        <h5 class="offcanvas-title fs-3" id="offcanvasScrollingLabel">
            {{ Auth::user()->role->name }}
        </h5>
    </div>

    <div class="accordion accordion-flush mt-3" id="accordionFlushExample">
        @if(Auth::user()->role->name == 'admin')
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingZero">
                    <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseZero" aria-expanded="false" aria-controls="flush-collapseZero">
                        <i class="fa-solid fa-shopping-bag me-2"></i> PURCHASES
                    </button>
                </h2>
                <div id="flush-collapseZero" class="accordion-collapse collapse" aria-labelledby="flush-headingZero"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <a href="{{ route('vendor.purchase-orders.list') }}" class="nav-link">
                            Display
                        </a>
                    </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                        <i class="fa-solid fa-users me-2"></i> USERS
                    </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                     data-bs-parent="#accordionFlushExample">
                    <div class="accordion-body">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            View Users
                        </a>
                    </div>
                </div>
            </div>
        @endif
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingTwo">
                <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <i class="fa-solid fa-list me-2"></i> CATEGORIES
                </button>
            </h2>
            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <a href="{{ route('category.create') }}" class="nav-link">Create Category</a>
                </div>
                <div class="accordion-body">
                    <a href="{{ route('vendor.category.index') }}" class="nav-link">View Categories</a>
                </div>
            </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    <i class="fa-solid fa-computer me-2"></i> PRODUCTS
                </button>
            </h2>
            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <a href="{{ route('vendor.product.create') }}" class="nav-link">Create Product</a>
                </div>
                <div class="accordion-body">
                    <a href="{{ route('vendor.product.index') }}" class="nav-link">
                        View Products
                    </a>
                </div>
            </div>
        </div>
            <div class="accordion-item">
            <h2 class="accordion-header" id="flush-headingThree">
                <button class="accordion-button collapsed py-4" type="button" data-bs-toggle="collapse"
                        data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                    <i class="fa-solid fa-envelope me-2"></i> CONTACTS
                </button>
            </h2>
            <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour"
                 data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <a href="{{ route('contact.index') }}" class="nav-link">View Messages</a>
                </div>
            </div>
        </div>
    </div>

</div>
<!--End Offcanvas-->

@yield('scripts')
</body>

</html>
