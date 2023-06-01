@extends('layouts.admin.template-admin')

@section('title')
    <title>Dashboard Admin | Print-Shop</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Selamat Datang {{ Auth::user()->name }}</h3>
                        <h6 class="font-weight-normal mb-0 text-secondary mt-3">Selamat datang di Dashboard
                            - Panel Manajemen Data Admin,
                            <span class="text-primary"><b>yuk mulai manage data kamu 😊</b></span>
                        </h6>
                    </div>
                    <div class="col-12 col-xl-4">
                        <div class="justify-content-end d-flex">
                            <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                    id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="mdi mdi-calendar"></i>
                                    Hari ini :
                                    <script>
                                        var d = (new Date()).toString().split(' ').splice(1, 3).join(' ');
                                        document.write(d)
                                    </script>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card card-hover">
                    <div class="card-people p-3">
                        <img src="{{ asset('admin/images/banner-admin.jpg') }}" alt="people">
                    </div>
                </div>
            </div>
            <div class="col-md-6 grid-margin transparent">
                <div class="row">
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-dark-blue">
                            <a href="{{ route('product.index') }}" class="menu-card">
                                <div class="card-body">
                                    <p class="mb-4 font-weight-bold">Manajemen Produk</p>
                                    <p class="fs-30 mb-2">{{ $productsCount }}</p>
                                    <p>CRUD Data Product</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 stretch-card transparent">
                        <div class="card card-tale">
                            <a href="{{ route('service.index') }}" class="menu-card">
                                <div class="card-body">
                                    <p class="mb-4 font-weight-bold">Manajemen Jasa</p>
                                    <p class="fs-30 mb-2">{{ $servicesCount }}</p>
                                    <p>CRUD Data Service</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-blue">
                            <a href="{{ route('admin.manage.transaction') }}" class="menu-card">
                                <div class="card-body">
                                    <p class="mb-4 font-weight-bold">Manajemen Transaksi Produk</p>
                                    <p class="fs-30 mb-2">{{ $transactionCount }}</p>
                                    <p>Update Tracking Transaction</p>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                        <div class="card card-light-danger">
                            <a href="{{ route('admin.manage.order') }}" class="menu-card">
                                <div class="card-body">
                                    <p class="mb-4 font-weight-bold">Manajemen Pesanan Jasa</p>
                                    <p class="fs-30 mb-2">{{ $orderCount }}</p>
                                    <p>Update Tracking Order</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- <div class="row">
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card card-hover">
                    <div class="card-body">
                        <h4 class="card-title">Segmentasi Konten Penjualan</h4>
                        <canvas id="doughnutChart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card card-hover">
                    <div class="card-body">
                        <h4 class="card-title">Jumlah Penjualan Per-Bulan</h4>
                        <canvas id="barChart"></canvas>
                    </div>
                </div>
            </div>
        </div> --}}
    </div>
@endsection

@section('script')
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/js/analytics-print-shop.js') }}"></script>

    <script>
        const DashboardNav = document.getElementById('dashboard-nav');
        DashboardNav.classList.add('active');
    </script>
@endsection
