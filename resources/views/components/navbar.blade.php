<nav class="navbar bg-th-secondary sticky-top navbar-expand-md shadow-sm border-th-primary border-bottom"
     data-bs-theme="dark">
    <div class="container d-flex justify-content-between">
        <a class="navbar-brand text-light" href="{{ route('home') }}">
                <span class="logo justify-content-center align-items-center p-0">
                    <span class="logo-icon hor-bar1"></span>
                    <span class="logo-icon ver-bar1"></span>
                    <span class="logo-icon hor-bar2"></span>
                    <span class="logo-icon ver-bar2"></span>
                </span><span class="erre">R</span>Tech
        </a>
        <button class="navbar-toggler d-flex d-lg-none collapsed flex-column justify-content-around p-0" type="button"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="toggler-icon top-bar"></span>
            <span class="toggler-icon mid-bar"></span>
            <span class="toggler-icon bot-bar"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-grow: 0">
            <!-- Center Of Navbar -->
            <ul class="navbar-nav me-auto navbar-center">
                <li class="nav-item">
                    <a class="navLink {{ request()->routeIs('home') ? 'activo' : '' }}" href="{{ route('home') }}">
                        <i class="fa-solid fa-house me-2"></i>{{ __('Home') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navLink {{ request()->routeIs('category.index') ? 'activo' : '' }}"
                       href="{{ route('category.index') }}">{{ __('Category') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="navLink {{ request()->routeIs('product.index') ? 'activo' : '' }}"
                       href="{{ route('product.index') }}">
                        {{ __('Product') }}
                    </a>
                </li>

            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav mx-auto fs-5 text-end">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}"><i
                                    class="fa-solid fa-arrow-right-to-bracket me-2"></i>{{ __('Login') }}</a>
                        </li>
                    @endif

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}"><i
                                    class="fa-solid fa-pen-to-square me-2"></i>{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li>
                        <a class="nav-link" href="{{ route('shoppingCart.index') }}"><i
                                class="fa-solid fa-shopping-cart me-2"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                           data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('user.settings') }}">{{ __('Settings') }}</a>

                            <a class="dropdown-item" href="{{ route('purchase-orders.index') }}">{{ __('My Purchases') }}</a>

                            <!-- Agregar otra barra horizontal -->
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
