<!-- partial:partials/_navbar.html -->
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('admin/images/print-shop-logo-title.png') }}" class="mr-2" alt="logo" /></a>
        <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}"><img
                src="{{ asset('admin/images/print-shop-logo.png') }}" alt="logo" /></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item nav-search d-none d-lg-block hidden">
                <div class="input-group">
                    <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                        <span class="input-group-text" id="search">
                            <i class="icon-search"></i>
                        </span>
                    </div>
                    <input type="text" class="form-control" id="navbar-search-input" placeholder="Search data"
                        aria-label="search" aria-describedby="search">
                </div>
            </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    @if (Auth::user()->photo == 'empty')
                        <img src="{{ asset('admin/images/admin-profile.png') }}" alt="profile" />
                    @else
                        <img src="{{ Storage::url(Auth::user()->photo) }}" alt="profile" />
                    @endif

                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <a href="{{ route('admin.profile', auth()->user()->id) }}" class="dropdown-item">
                        <i class="ti-user text-primary"></i>
                        Profile
                    </a>
                    <a href="{{ route('customer.beranda') }}" class="dropdown-item">
                        <i class="ti-home text-primary"></i>
                        Beranda
                    </a>
                    <a href="{{ route('logout.page') }}" class="dropdown-item">
                        <i class="ti-power-off text-primary"></i>
                        Logout
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
            data-toggle="offcanvas">
            <span class="icon-menu"></span>
        </button>
    </div>
</nav>
