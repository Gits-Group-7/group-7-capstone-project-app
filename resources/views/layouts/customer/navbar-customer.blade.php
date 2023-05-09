<!--Main Navigation-->
<header class="fixed-top">
    <!-- Jumbotron -->
    <div class="p-3 text-center bg-white border-bottom">
        <div class="container">
            <div class="row gy-3">
                <!-- Left elements -->
                <div class="col-lg-2 col-sm-4 col-4 d-flex">
                    <a href="{{ route('customer.beranda') }}" class="float-start my-auto">
                        <img class="logo-1 img-fluid" src="{{ asset('admin/images/print-shop-logo-title.png') }}" />
                        <img class="logo-2 img-fluid" src="{{ asset('admin/images/print-shop-logo.png') }}" />
                    </a>
                </div>
                <!-- Left elements -->

                <!-- Center elements -->
                <div class="order-lg-last col-lg-5 col-sm-8 col-8">
                    <div class="d-flex float-end p-3">
                        <a href="{{ route('customer.store') }}"
                            class="btn-theme me-1 py-1 px-3 nav-link d-flex align-items-center">
                            <i class="fa-solid fa-store m-1 me-md-2"></i>
                            <p class="d-none d-md-block mb-0">Toko</p>
                        </a>
                        <a href="{{ route('cart.index') }}"
                            class="btn-theme me-1 py-1 px-3 nav-link d-flex align-items-center">
                            <i class="fas fa-shopping-cart m-1 me-md-2"></i>
                            <p class="d-none d-md-block mb-0">Keranjang</p>
                        </a>
                        @if (auth()->user() != null && auth()->user()->role == 'admin')
                            <a href="{{ route('admin.dashboard') }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">{{ Auth::user()->name }}</p>
                            </a>
                        @elseif (Auth()->user() != null && auth()->user()->role == 'customer')
                            <a href="{{ route('customer.profile', Auth::user()->id) }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">{{ Auth::user()->name }}</p>
                            </a>
                        @else
                            <a href="{{ route('customer.login') }}"
                                class="btn-theme py-1 px-3 nav-link d-flex align-items-center">
                                <i class="fas fa-user-alt m-1 me-md-2"></i>
                                <p class="d-none d-md-block mb-0">Login</p>
                            </a>
                        @endif

                    </div>
                </div>
                <!-- Center elements -->

                <!-- Right elements -->
                <div class="col-lg-5 col-md-12 col-12 d-flex">
                    <div class="input-group float-center my-auto">
                        <div class="form-outline">
                            <input type="search" id="form1" class="form-control" />
                            <label class="form-label" for="form1">
                                Temukan produk atau jasa favoritmu dengan mudah di sini!</label>
                        </div>
                        <button type="button" class="btn search-theme shadow-0">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
                <!-- Right elements -->
            </div>
        </div>
    </div>
    <!-- Jumbotron -->

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-theme">
        <!-- Container wrapper -->
        <div class="container justify-content-center justify-content-md-between">
            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                data-mdb-target="#navbarLeftAlignExample" aria-controls="navbarLeftAlignExample" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-bars"></i>
            </button>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="navbarLeftAlignExample">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('customer.beranda') }}">Beranda</a>
                    </li>

                    <!-- Navbar dropdown Product -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Katalog Produk
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach ($category_products as $item)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('customer.beranda') }}#{{ underscore($item->name) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Navbar dropdown Service -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownServices" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Katalog Jasa
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownServices">
                            @foreach ($category_services as $item)
                                <li>
                                    <a class="dropdown-item"
                                        href="{{ route('customer.beranda') }}#{{ underscore($item->name) }}">{{ $item->name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </li>

                    <!-- Navbar dropdown Lain-lain -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-mdb-toggle="dropdown" aria-expanded="false">
                            Lain-lain
                        </a>
                        <!-- Dropdown menu -->
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li>
                                <a class="dropdown-item" href="#">About</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Promo</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Support</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Join with Us</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Left links -->
            </div>
        </div>
        <!-- Container wrapper -->
    </nav>
    <!-- Navbar -->
</header>
