<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item" id="dashboard-nav">
            <a href="{{ route('admin.dashboard') }}" class="nav-link" href="index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <hr>
        <li class="nav-item" id="kategori-nav">
            <a class="nav-link" data-toggle="collapse" href="#category-nav" aria-expanded="false"
                aria-controls="category-nav">
                <i class="ti-bookmark menu-icon"></i>
                <span class="menu-title">Kategori</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.index') }}">Daftar Kategori</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('category.create') }}">Tambah Kategori</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" id="produk-nav">
            <a class="nav-link" data-toggle="collapse" href="#product-nav" aria-expanded="false"
                aria-controls="product-nav">
                <i class="ti-package menu-icon"></i>
                <span class="menu-title">Produk</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.index') }}">Daftar Produk</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('product.create') }}">Tambah Produk</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" id="jasa-nav">
            <a class="nav-link" data-toggle="collapse" href="#service-nav" aria-expanded="false"
                aria-controls="service-nav">
                <i class="ti-briefcase menu-icon"></i>
                <span class="menu-title">Jasa</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="service-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('service.index') }}">Daftar Jasa</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('service.create') }}">Tambah Jasa</a>
                    </li>
                </ul>
            </div>
        </li>
        <hr>
        <li class="nav-item" id="transaksi-nav">
            <a class="nav-link" data-toggle="collapse" href="#transaction-nav" aria-expanded="false"
                aria-controls="transaction-nav">
                <i class="ti-shopping-cart menu-icon"></i>
                <span class="menu-title">Transaksi</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="transaction-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#!">Daftar Transaksi</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" id="pesanan-nav">
            <a class="nav-link" data-toggle="collapse" href="#order-nav" aria-expanded="false"
                aria-controls="order-nav">
                <i class="ti-shopping-cart-full menu-icon"></i>
                <span class="menu-title">Order</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="order-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#!">Daftar Order</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" id="layanan-pelanggan-nav">
            <a class="nav-link" data-toggle="collapse" href="#customer-service-nav" aria-expanded="false"
                aria-controls="customer-service-nav">
                <i class="ti-server menu-icon"></i>
                <span class="menu-title">CS Data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="customer-service-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.customer') }}">Daftar
                            Customer</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.transaction.order') }}">Transaksi
                            Order</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link"
                            href="{{ route('admin.transaction.details') }}">Transaksi Details</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.order.details') }}">Order
                            Details</a>
                    </li>
                </ul>
            </div>
        </li>

        {{-- start template menu --}}
        <hr>
        <li class="nav-item">
            <a class="nav-link" href="pages/documentation/documentation.html">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Documentation</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="icon-layout menu-icon"></i>
                <span class="menu-title">UI Elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.button') }}">Buttons</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
                aria-controls="form-elements">
                <i class="icon-columns menu-icon"></i>
                <span class="menu-title">Form elements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="{{ route('admin.form') }}">Basic
                            Form</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Charts</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('admin.chart') }}">ChartJs</a>
                    </li>
                </ul>
            </div>
        </li>
    </ul>
</nav>
