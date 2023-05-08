<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item" id="dashboard-nav">
            <a href="{{ route('customer.profile', $customer->id) }}" class="nav-link" href="index.html">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Profile Beranda</span>
            </a>
        </li>
        <hr>

        <li class="nav-item" id="kategori-nav">
            <a class="nav-link" data-toggle="collapse" href="#category-nav" aria-expanded="false"
                aria-controls="category-nav">
                <i class="ti-agenda menu-icon"></i>
                <span class="menu-title">Riwayat Pesanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="category-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#!">Daftar Transaksi</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#!">Daftar Order</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item" id="produk-nav">
            <a class="nav-link" data-toggle="collapse" href="#product-nav" aria-expanded="false"
                aria-controls="product-nav">
                <i class="ti-truck menu-icon"></i>
                <span class="menu-title">Tracking Pesanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="product-nav">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#!">Transaksi Produk</a>
                    </li>
                    <li class="nav-item"> <a class="nav-link" href="#!">Order Jasa</a>
                    </li>
                </ul>
            </div>
        </li>

    </ul>
</nav>
