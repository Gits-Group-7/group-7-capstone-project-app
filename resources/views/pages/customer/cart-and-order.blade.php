@extends('layouts.customer.template-customer')

@section('title')
    <title>Halaman Cart dan Order | Print-Shop</title>
@endsection

@section('css')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection

@php
    function roundToOneDecimal($number)
    {
        $rounded = round($number, 1); // Bulatkan angka dengan satu angka di belakang koma
        return number_format($rounded, 1); // Format angka dengan satu angka di belakang koma
    }
    
    // fungsi konversi data tipe date ke tanggal
    function dateConversion($date)
    {
        $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $slug = explode('-', $date);
        return $slug[2] . ' ' . $month[(int) $slug[1]] . ' ' . $slug[0];
    }
    
    function priceConversion($price)
    {
        $formattedPrice = number_format($price, 0, ',', '.');
        return $formattedPrice;
    }
    
    // fungsi auto repair one word
    function underscore($string)
    {
        // Ubah string menjadi lowercase
        $string = strtolower($string);
    
        // Ganti spasi dengan underscore
        $string = str_replace(' ', '_', $string);
    
        return $string;
    }
@endphp

@section('content')
    <!-- cart + summary -->
    <section class="mt-5 beranda-responsive cart-order-responsive">
        <div class="container">
            <div class="row">

                <!-- cart -->
                <div class="col-lg-12 mb-4">
                    <div class="row d-flex justify-content-between">
                        <div class="col-lg-6 d-flex">
                            <div class="">
                                <h4 class="card-title mb-4 alert alert-primary mt-3">Manajemen Pesanan</h4>
                            </div>
                        </div>
                        <div class="col-lg-4 d-flex justify-content-end">
                            <div class="my-auto pb-3">
                                <div class="">
                                    <a href="{{ route('transaction.order.customer.list') }}"
                                        class="btn btn-checklist w-100 shadow-0 mb-2">Daftar
                                        Transaksi Order</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card shadow-sm card-hover">
                        <div class="rounded-2 px-3 py-2 bg-white">
                            <!-- Pills navs -->
                            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                <li class="nav-item d-flex" role="presentation">
                                    <a class="nav-link d-flex align-items-center justify-content-center w-100 bg-secondary text-white nav-side-theme-product active"
                                        id="ex1-tab-1" data-mdb-toggle="pill" href="#product-cart" role="tab"
                                        aria-controls="product-cart" aria-selected="true">Pesanan Produk</a>
                                </li>
                                <li class="nav-item d-flex" role="presentation">
                                    <a class="nav-link d-flex align-items-center justify-content-center w-100 bg-secondary text-white nav-side-theme-service"
                                        id="ex1-tab-2" data-mdb-toggle="pill" href="#service-order" role="tab"
                                        aria-controls="service-order" aria-selected="false">Order Jasa</a>
                                </li>
                            </ul>
                            <!-- Pills navs -->

                            <!-- Pills content -->
                            <div class="tab-content" id="ex1-content">
                                {{-- product cart list --}}
                                <div class="tab-pane fade show active" id="product-cart" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-4">
                                            @if ($cart_products->count())
                                                @foreach ($cart_products as $item)
                                                    {{-- mengambil data cart product customer --}}
                                                    <div class="row gy-3 mb-4">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="me-lg-5">
                                                                <div class="d-flex justify-content-around pt-3">
                                                                    <div class="">
                                                                        <img src="{{ Storage::url($item->photo) }}"
                                                                            class="border rounded me-3 p-2"
                                                                            style="width: 96px; height: 96px;" />
                                                                    </div>

                                                                    <div class="">
                                                                        <span
                                                                            class="nav-link pt-2 fw-bold fs-title text-justify">{{ $item->name }}</span>

                                                                        <div class="d-flex justify-content-start mt-2">
                                                                            <span
                                                                                class="text-black-theme text-center alert-primary px-3 alert-border-radius">
                                                                                @foreach ($category_product_name as $value)
                                                                                    @if ($item->product_id == $value->id)
                                                                                        {{ $value->category->name }}
                                                                                    @endif
                                                                                @endforeach
                                                                            </span>

                                                                            <span>&ensp;</span>

                                                                            <span
                                                                                class="text-black-theme text-center alert-success px-3 alert-border-radius">
                                                                                {{ $item->condition }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-6 d-flex">
                                                            <div class="pt-2 mx-auto my-auto">
                                                                <small class="text-muted text-nowrap"> Rp.
                                                                    {{ priceConversion($item->price) }} /
                                                                    per item
                                                                </small> <br>
                                                                <span class="h6 fw-bold">
                                                                    Total :
                                                                    Rp. {{ priceConversion($item->total_price) }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-6 d-flex">
                                                            <div class="mx-auto my-auto d-flex justify-content-around">
                                                                {{-- Modal Button --}}
                                                                <button type="button" class="btn btn-checklist"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal_product{{ $item->id }}">
                                                                    Manage
                                                                </button>
                                                                &ensp;
                                                                <a href="{{ route('cart.delete.product', $item->id) }}"
                                                                    class="btn btn-delete px-2">
                                                                    <i class="fa-solid fa-trash fa-lg px-1"></i>
                                                                </a>
                                                            </div>

                                                            {{-- Modal --}}
                                                            <div class="modal fade" tabindex="-1"
                                                                id="modal_product{{ $item->id }}">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Ubah Pesanan Produk
                                                                            </h5>

                                                                            <!--begin::Close-->
                                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                                <i class="ki-duotone ki-cross fs-2x"></i>
                                                                            </div>
                                                                            <!--end::Close-->
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <form class="m-3"
                                                                                action="{{ route('cart.update.product', $item->id) }}"
                                                                                method="POST">
                                                                                @method('put')
                                                                                @csrf

                                                                                <div class="form-group mb-3">
                                                                                    <label for="is_checkout_product"
                                                                                        class="form-label">
                                                                                        Tambahkan Produk ke Cart
                                                                                    </label>
                                                                                    <select
                                                                                        class="form-select @error('is_checkout_product') is-invalid @enderror"
                                                                                        id="is_checkout_product"
                                                                                        name="is_checkout_product"
                                                                                        aria-label="Default select example"
                                                                                        required>
                                                                                        <option value="">
                                                                                            Pilih Opsi
                                                                                        </option>
                                                                                        <option value="1"
                                                                                            {{ $item->is_checkout == true || 1 ? 'selected' : '' }}>
                                                                                            Tambah
                                                                                        </option>
                                                                                        <option value="0"
                                                                                            {{ $item->is_checkout == false || 0 ? 'selected' : '' }}>
                                                                                            Jangan
                                                                                            Tambahkan
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                @if ($errors->has('is_checkout_product'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *option Tambah ke Cart harus dipilih
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group mb-3">
                                                                                    <label for="quantity_product"
                                                                                        class="form-label">Jumlah
                                                                                        Produk</label>
                                                                                    <input type="number"
                                                                                        class="form-control @error('quantity') is-invalid @enderror"
                                                                                        id="quantity_product"
                                                                                        name="quantity" min="1"
                                                                                        max="99"
                                                                                        value="{{ $item->quantity }}">
                                                                                </div>
                                                                                @if ($errors->has('quantity'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *field Jumlah Produk harus di isi
                                                                                    </div>
                                                                                @endif

                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-unconfirm"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-confirm">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span>
                                                    Silahkan tambahkan Pesanan Produk terlebih dahulu.
                                                    <a href="{{ route('customer.beranda') }}">Beranda</a>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-4">
                                            <div class="card shadow-sm border card-hover">
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <span class="fw-bold">Daftar Pesanan Produk :</span>
                                                    </div>

                                                    @if ($cart_products_check->count())
                                                        <ul>
                                                            @foreach ($cart_products_check as $item)
                                                                <li>
                                                                    <p class="mb-2">
                                                                        <span class="limit-text-title fw-medium"
                                                                            title="{{ $item->name }}">
                                                                            {{ $item->name }}
                                                                        </span>
                                                                        <span class="limit-text-title">
                                                                            Jumlah({{ $item->quantity }}) :
                                                                            <i>Rp.
                                                                                {{ priceConversion($item->total_price) }}
                                                                            </i>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span>Tidak ada produk yang ditambahkan ke Keranjang</span>
                                                    @endif

                                                    <hr>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2 fw-bold">Total Cart :</p>
                                                        <p class="mb-2 fw-bold">Rp.
                                                            {{ priceConversion($total_price_cart) }}
                                                        </p>
                                                    </div>

                                                    @if ($cart_products_check->count())
                                                        @if (DB::table('transaction_orders')->where('type_transaction_order', 'product')->count())
                                                            @if ($last_transaction_product != null)
                                                                @if ($last_transaction_product->status_delivery == 'Start Order')
                                                                    <div class="mt-3">
                                                                        <a href="{{ route('transaction.order.customer.list') }}"
                                                                            type="button"
                                                                            class="btn btn-unchecklist w-100 shadow-0 mb-2">Selesaikan
                                                                            Proses
                                                                            Transaksi</a>
                                                                    </div>
                                                                @else
                                                                    <div class="mt-3">
                                                                        <button type="submit"
                                                                            class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#transactionProduct">Beli
                                                                            Sekarang</button>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="mt-3">
                                                                    <button type="submit"
                                                                        class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#transactionProduct">Beli
                                                                        Sekarang</button>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="mt-3">
                                                                <button type="submit"
                                                                    class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#transactionProduct">Beli
                                                                    Sekarang</button>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="mt-3">
                                                            <a href="{{ route('customer.beranda') }}" type="submit"
                                                                class="btn btn-checklist w-100 shadow-0 mb-2">
                                                                Mohon Tambahkan Produk
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="transactionProduct" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Tambah
                                                                        Transaksi Produk?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                {{-- <div class="modal-body"></div> --}}
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-unconfirm"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <a href="{{ route('transaction.order.product.store', auth()->user()->id) }}"
                                                                        type="button" class="btn btn-confirm">Oke</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade mb-2" id="service-order" role="tabpanel">
                                    {{-- service order list --}}
                                    <div class="row">
                                        <div class="col-lg-9 col-md-12 col-sm-12 col-12 mb-4">
                                            @if ($order_services->count())
                                                @foreach ($order_services as $item)
                                                    {{-- mengambil data order service customer --}}
                                                    <div class="row gy-3 mb-4">
                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="me-lg-5">
                                                                <div class="d-flex justify-content-around pt-3">
                                                                    <div class="">
                                                                        <img src="{{ Storage::url($item->photo) }}"
                                                                            class="border rounded me-3 p-2"
                                                                            style="width: 96px; height: 96px;" />
                                                                    </div>

                                                                    <div class="">
                                                                        <span
                                                                            class="nav-link pt-2 fw-bold fs-title text-justify">{{ $item->name }}</span>

                                                                        <div class="d-flex justify-content-start mt-2">
                                                                            <span
                                                                                class="text-black-theme text-center alert-primary px-3 alert-border-radius d-flex">
                                                                                @foreach ($category_service_name as $value)
                                                                                    <span class="mx-auto my-auto">
                                                                                        @if ($item->service_id == $value->id)
                                                                                            {{ $value->category->name }}
                                                                                        @endif
                                                                                    </span>
                                                                                @endforeach
                                                                            </span>

                                                                            <span>&ensp;</span>

                                                                            <span
                                                                                class="text-black-theme text-center alert-danger px-3 alert-border-radius">
                                                                                {{ dateConversion($item->deadline) }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-6 d-flex">
                                                            <div class="pt-2 mx-auto my-auto">
                                                                <small class="text-muted text-nowrap"> Rp.
                                                                    {{ priceConversion($item->price_per_pcs) }} /
                                                                    per item
                                                                </small> <br>
                                                                <span class="h6 fw-bold">
                                                                    Total :
                                                                    Rp. {{ priceConversion($item->total_price) }}
                                                                </span>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-6 d-flex">
                                                            <div class="mx-auto my-auto d-flex justify-content-around">
                                                                {{-- Modal Button --}}
                                                                <button type="button" class="btn btn-checklist"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modal_service{{ $item->id }}">
                                                                    Manage
                                                                </button>
                                                                &ensp;
                                                                <a href="{{ route('order.delete.service', $item->id) }}"
                                                                    class="btn btn-delete px-2">
                                                                    <i class="fa-solid fa-trash fa-lg px-1"></i>
                                                                </a>
                                                            </div>

                                                            {{-- Modal --}}
                                                            <div class="modal fade" tabindex="-1"
                                                                id="modal_service{{ $item->id }}">
                                                                <div class="modal-dialog modal-dialog-scrollable">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Ubah Pesanan Jasa
                                                                            </h5>

                                                                            <!--begin::Close-->
                                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                                data-bs-dismiss="modal"
                                                                                aria-label="Close">
                                                                                <i class="ki-duotone ki-cross fs-2x"></i>
                                                                            </div>
                                                                            <!--end::Close-->
                                                                        </div>

                                                                        <div class="modal-body">
                                                                            <form class="m-3"
                                                                                action="{{ route('order.update.service', $item->id) }}"
                                                                                method="POST"
                                                                                enctype="multipart/form-data">
                                                                                @method('put')
                                                                                @csrf

                                                                                <div class="form-group mb-3">
                                                                                    <label for="is_checkout_service"
                                                                                        class="form-label">
                                                                                        Tambahkan Jasa ke Order
                                                                                    </label>
                                                                                    <select
                                                                                        class="form-select @error('is_checkout_service') is-invalid @enderror"
                                                                                        id="is_checkout_service"
                                                                                        name="is_checkout_service"
                                                                                        aria-label="Default select example"
                                                                                        required>
                                                                                        <option value="">
                                                                                            Pilih Opsi
                                                                                        </option>
                                                                                        <option value="1"
                                                                                            {{ $item->is_checkout == true || 1 ? 'selected' : '' }}>
                                                                                            Tambah
                                                                                        </option>
                                                                                        <option value="0"
                                                                                            {{ $item->is_checkout == false || 0 ? 'selected' : '' }}>
                                                                                            Jangan
                                                                                            Tambahkan
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                @if ($errors->has('is_checkout_service'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *option Tambah ke Order harus
                                                                                        dipilih
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group mb-3">
                                                                                    <label for="quantity_service"
                                                                                        class="form-label">Jumlah
                                                                                        Produk</label>
                                                                                    <input type="number"
                                                                                        class="form-control @error('quantity') is-invalid @enderror"
                                                                                        id="quantity_service"
                                                                                        name="quantity" min="1"
                                                                                        max="99"
                                                                                        value="{{ $item->quantity }}">
                                                                                </div>
                                                                                @if ($errors->has('quantity'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *field Jumlah Produk harus di isi
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group mb-3">
                                                                                    <label for="material"
                                                                                        class="form-label">
                                                                                        Material
                                                                                    </label>
                                                                                    <select
                                                                                        class="form-select @error('material') is-invalid @enderror"
                                                                                        id="material" name="material"
                                                                                        aria-label="Default select example"
                                                                                        required>
                                                                                        <option value="">
                                                                                            Pilih Opsi Bahan
                                                                                        </option>
                                                                                        <option value="Polo"
                                                                                            {{ $item->material == 'Polo' ? 'selected' : '' }}>
                                                                                            Polo
                                                                                        </option>
                                                                                        <option value="Katun"
                                                                                            {{ $item->material == 'Katun' ? 'selected' : '' }}>
                                                                                            Katun
                                                                                        </option>
                                                                                        <option value="Polyester"
                                                                                            {{ $item->material == 'Polyester' ? 'selected' : '' }}>
                                                                                            Polyester
                                                                                        </option>
                                                                                        <option value="Rayon"
                                                                                            {{ $item->material == 'Rayon' ? 'selected' : '' }}>
                                                                                            Rayon
                                                                                        </option>
                                                                                        <option value="Linen"
                                                                                            {{ $item->material == 'Linen' ? 'selected' : '' }}>
                                                                                            Linen
                                                                                        </option>
                                                                                        <option value="Wool"
                                                                                            {{ $item->material == 'Wool' ? 'selected' : '' }}>
                                                                                            Wool
                                                                                        </option>
                                                                                        <option value="Spandex"
                                                                                            {{ $item->material == 'Spandex' ? 'selected' : '' }}>
                                                                                            Spandex
                                                                                        </option>
                                                                                    </select>
                                                                                </div>
                                                                                @if ($errors->has('material'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *option Bahan Material harus dipilih
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group mb-3">
                                                                                    <label for="custom_design"
                                                                                        class="form-label">Foto Custom
                                                                                        Desain *(optional)
                                                                                    </label>
                                                                                    <input id="custom_design"
                                                                                        name="custom_design"
                                                                                        class="form-control @error('custom_design') is-invalid @enderror"
                                                                                        type="file" id="formFile">
                                                                                </div>
                                                                                @if ($errors->has('custom_design'))
                                                                                    <div
                                                                                        class="invalid feedback text-danger mb-3">
                                                                                        *upload gambar kurang dari 10
                                                                                        Mb (jpg/png/webp)
                                                                                    </div>
                                                                                @endif

                                                                                <div class="form-group mb-3">
                                                                                    <label for="deadline"
                                                                                        class="form-label">Deadline
                                                                                        Order
                                                                                    </label>
                                                                                    <input type="date"
                                                                                        class="form-control"
                                                                                        id="deadline" name="deadline"
                                                                                        min="1" max="99"
                                                                                        value="{{ $item->deadline }}">
                                                                                </div>

                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-unconfirm"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <button type="submit"
                                                                                        class="btn btn-confirm">Simpan</button>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <span>
                                                    Silahkan tambahkan Order Jasa terlebih dahulu.
                                                    <a href="{{ route('customer.beranda') }}">Beranda</a>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-lg-3 col-md-12 col-sm-12 col-12 mb-4">
                                            <div class="card shadow-sm border card-hover">
                                                <div class="card-body">
                                                    <div class="card-title">
                                                        <span class="fw-bold">Daftar Pesanan Jasa :</span>
                                                    </div>

                                                    @if ($order_services_check->count())
                                                        <ul>
                                                            @foreach ($order_services_check as $item)
                                                                <li>
                                                                    <p class="mb-2">
                                                                        <span class="limit-text-title fw-medium"
                                                                            title="{{ $item->name }}">
                                                                            {{ $item->name }}
                                                                        </span>
                                                                        <span class="limit-text-title">
                                                                            Jumlah({{ $item->quantity }}) :
                                                                            <i>Rp.
                                                                                {{ priceConversion($item->total_price) }}
                                                                            </i>
                                                                        </span>
                                                                    </p>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @else
                                                        <span>Tidak ada jasa yang ditambahkan ke order</span>
                                                    @endif

                                                    <hr>
                                                    <div class="d-flex justify-content-between">
                                                        <p class="mb-2 fw-bold">Total Order :</p>
                                                        <p class="mb-2 fw-bold">Rp.
                                                            {{ priceConversion($total_price_order) }}
                                                        </p>
                                                    </div>

                                                    @if ($order_services_check->count())
                                                        @if (DB::table('transaction_orders')->where('type_transaction_order', 'service')->count())
                                                            @if ($last_order_service != null)
                                                                @if ($last_order_service->status_delivery == 'Start Order')
                                                                    <div class="mt-3">
                                                                        <a href="{{ route('transaction.order.customer.list') }}"
                                                                            type="button"
                                                                            class="btn btn-unchecklist w-100 shadow-0 mb-2">Selesaikan
                                                                            Proses
                                                                            Pesanan</a>
                                                                    </div>
                                                                @else
                                                                    <div class="mt-3">
                                                                        <button type="submit"
                                                                            class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#orderService">Pesan
                                                                            Sekarang</button>
                                                                    </div>
                                                                @endif
                                                            @else
                                                                <div class="mt-3">
                                                                    <button type="submit"
                                                                        class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                        data-bs-toggle="modal"
                                                                        data-bs-target="#orderService">Pesan
                                                                        Sekarang</button>
                                                                </div>
                                                            @endif
                                                        @else
                                                            <div class="mt-3">
                                                                <button type="submit"
                                                                    class="btn btn-checklist w-100 shadow-0 mb-2"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#orderService">Pesan
                                                                    Sekarang</button>
                                                            </div>
                                                        @endif
                                                    @else
                                                        <div class="mt-3">
                                                            <a href="{{ route('customer.beranda') }}" type="submit"
                                                                class="btn btn-checklist w-100 shadow-0 mb-2">
                                                                Mohon Tambahkan Jasa
                                                            </a>
                                                        </div>
                                                    @endif

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="orderService" tabindex="-1"
                                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">
                                                                        Tambah
                                                                        Order Jasa?</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                {{-- <div class="modal-body"></div> --}}
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-unconfirm"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <a href="{{ route('transaction.order.service.store', auth()->user()->id) }}"
                                                                        type="button" class="btn btn-confirm">Oke</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Pills content -->
                        </div>
                    </div>
                </div>
                <!-- cart -->
            </div>
        </div>
    </section>

    <section>
        <div class="container my-4">
            <div class="row">
                <div class="slider owl-carousel owl-theme">
                    @foreach ($recommend_items as $value)
                        {{-- mengambil data product --}}
                        @if ($value->category->type == 'product')
                            <div class="item col-md-12 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="{{ route('customer.product.detail', $value->id) }}" class="img-wrap">
                                        <img src="{{ Storage::url($value->photo) }}" class="card-img-top rounded"
                                            title="{{ $value->name }}" style="aspect-ratio: 1 / 1">
                                    </a>
                                    <div class="card-body p-0 pt-2">
                                        <h6 class="card-title product-title mt-2 pt-2 limit-text"
                                            title="{{ $value->name }}">
                                            <span class="text-black fw-bold">{{ $value->name }}</span>
                                        </h6>

                                        <div class="product-details">
                                            <div class="row">
                                                <div class="col d-flex">
                                                    <span class="card-text mx-auto my-auto">
                                                        <span class="text-theme-two fw-bold">Rp.
                                                            {{ priceConversion($value->price) }}</span>
                                                    </span>
                                                </div>
                                                <div class="col d-flex">
                                                    <div class="product-rating mx-auto my-auto">
                                                        @php
                                                            $product_id = $value->id;
                                                            $averageRating = $value->product_rating->where('product_id', $product_id)->avg('rating');
                                                            
                                                            $rating = $averageRating;
                                                            $whole = floor($rating);
                                                            $fraction = $rating - $whole;
                                                        @endphp

                                                        @for ($i = 0; $i < $whole; $i++)
                                                            <i class="fa fa-star"></i>
                                                        @endfor

                                                        @if ($fraction > 0)
                                                            <i class="fa-solid fa-star-half-stroke"></i>
                                                        @endif

                                                        <span class="rating-number fw-medium text-theme">
                                                            @php
                                                                $product_id = $value->id;
                                                                $product_rating = $value->product_rating->where('product_id', $product_id)->first();
                                                            @endphp

                                                            @if ($product_rating)
                                                                ({{ roundToOneDecimal($averageRating) }})
                                                            @else
                                                                Null
                                                            @endif
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row justify-content-between mt-1">
                                                <div class="col-6 d-flex">
                                                    @if ($value->status == 'Tersedia')
                                                        <span class="status-available-badge">
                                                            {{ $value->status }}
                                                        </span>
                                                    @elseif ($value->status == 'Pre Order')
                                                        <span class="status-pre-order-badge">
                                                            {{ $value->status }}
                                                        </span>
                                                    @elseif ($value->status == 'Habis')
                                                        <span class="status-run-out-badge">
                                                            {{ $value->status }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col bg-danger d-flex">
                                                <div class="mx-auto my-auto">
                                                    <span
                                                        class="fw-medium text-theme new-badge">{{ $value->condition }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Pengecekan Product --}}
                                        @if (!Auth::check())
                                            {{-- kondisi jika user masih guest --}}
                                            @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                                {{-- mengecek status barang --}}
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-2"
                                                        title="Produk Tidak Tersedia"> Produk Tidak Tersedia
                                                    </a>
                                                </div>
                                            @else
                                                {{-- kondisi normal login karena masih guest --}}
                                                <div class="row">
                                                    <a href="{{ route('customer.login') }}" type="button"
                                                        class="btn btn-checklist icon-cart-hover mt-2"
                                                        title="Tambahkan Produk ke Keranjang?"><i
                                                            class="fa-solid fa-cart-plus"></i>
                                                        &ensp; Add to Cart
                                                    </a>
                                                </div>
                                            @endif
                                            {{-- kondisijika user admin --}}
                                        @elseif (auth()->user() != null && auth()->user()->role == 'admin')
                                            {{-- mengecek status barang --}}
                                            @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                                {{-- mengecek status barang --}}
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-2"
                                                        title="Produk Tidak Tersedia"> Produk Tidak Tersedia
                                                    </a>
                                                </div>
                                            @else
                                                {{-- kondisi button non fungsi karena admin --}}
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist icon-cart-hover mt-2"
                                                        title="Tambahkan Produk ke Keranjang?"><i
                                                            class="fa-solid fa-cart-plus"></i>
                                                        &ensp; Add to Cart
                                                    </a>
                                                </div>
                                            @endif
                                            {{-- kondisi jika user customer --}}
                                        @elseif(auth()->user() != null && auth()->user()->role == 'customer')
                                            {{-- mengecek status barang --}}
                                            @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                                {{-- mengecek status barang --}}
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-2"
                                                        title="Produk Tidak Tersedia"> Produk Tidak Tersedia
                                                    </a>
                                                </div>
                                            @else
                                                {{-- mengecek apakah barang ada di keranjang milik customer ada atau tidak --}}
                                                @if (DB::table('cart_products')->where('product_id', $value->id)->where('user_id', auth()->user()->id)->exists())
                                                    {{-- jikalau barang ada di keranjang customer --}}
                                                    <div class="row">
                                                        <a href="#!" type="button"
                                                            class="btn btn-checklist-on icon-cart-hover mt-2"
                                                            title="Produk Ada Di Daftar Keranjang"> Produk
                                                            Sudah
                                                            Ditambahkan
                                                        </a>
                                                    </div>
                                                @else
                                                    {{-- jikalau barang tidak ada --}}
                                                    <form
                                                        action="{{ route('cart.store.product.home', ['user_id' => auth()->user()->id, 'product_id' => $value->id]) }}"
                                                        method="POST">
                                                        @csrf

                                                        <div class="row">
                                                            <button type="submit"
                                                                class="btn btn-checklist icon-cart-hover mt-2"
                                                                title="Tambahkan Produk ke Keranjang?"><i
                                                                    class="fa-solid fa-cart-plus"></i>
                                                                &ensp; Add to Cart
                                                            </button>
                                                        </div>
                                                    </form>
                                                @endif
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @elseif ($value->category->type == 'service')
                            <div class="item col-md-12 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="{{ route('customer.service.detail', $value->id) }}" class="img-wrap">
                                        <img src="{{ Storage::url($value->photo) }}" class="card-img-top rounded"
                                            title="{{ $value->name }}" style="aspect-ratio: 1 / 1">
                                    </a>
                                    <div class="card-body p-0 pt-2">
                                        <h6 class="card-title mt-2 pt-2 limit-text" title="{{ $value->name }}">
                                            <span class="text-black fw-bold">{{ $value->name }}</span>
                                        </h6>

                                        <div class="row">
                                            <div class="col d-flex">
                                                <span class="card-text mx-auto my-auto">
                                                    <span class="text-theme-two fw-bold">Rp.
                                                        {{ priceConversion($value->price_per_pcs) }}</span>
                                                </span>
                                            </div>
                                            <div class="col d-flex">
                                                <div class="product-rating mx-auto my-auto">
                                                    @php
                                                        $service_id = $value->id;
                                                        $averageRating = $value->service_rating->where('service_id', $service_id)->avg('rating');
                                                        
                                                        $rating = $averageRating;
                                                        $whole = floor($rating);
                                                        $fraction = $rating - $whole;
                                                    @endphp

                                                    @for ($i = 0; $i < $whole; $i++)
                                                        <i class="fa fa-star"></i>
                                                    @endfor

                                                    @if ($fraction > 0)
                                                        <i class="fa-solid fa-star-half-stroke"></i>
                                                    @endif

                                                    <span class="rating-number fw-medium text-theme">
                                                        @php
                                                            $service_id = $value->id;
                                                            $service_rating = $value->service_rating->where('service_id', $service_id)->first();
                                                        @endphp

                                                        @if ($service_rating)
                                                            ({{ roundToOneDecimal($averageRating) }})
                                                        @else
                                                            Null
                                                        @endif
                                                    </span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col bg-danger d-flex">
                                                <div class="mx-auto my-auto">
                                                    <span
                                                        class="fw-medium text-theme new-badge">{{ $value->estimation }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row justify-content-between my-2">
                                            <div class="col-6 d-flex">
                                                <span class="status-available-badge">
                                                    {{ $value->category->name }}
                                                </span>
                                            </div>
                                        </div>

                                        {{-- Pengecekan Service --}}
                                        @if (!Auth::check())
                                            {{-- kondisi jika user masih guest --}}
                                            <div class="row">
                                                <a href="{{ route('customer.login') }}" type="button"
                                                    class="btn btn-checklist icon-cart-hover mt-2"
                                                    title="Tambahkan Jasa ke Pesanan?"><i
                                                        class="fa-solid fa-cart-plus"></i>
                                                    &ensp; Add to Order
                                                </a>
                                            </div>
                                            {{-- kondisi jika user admin --}}
                                        @elseif (auth()->user() != null && auth()->user()->role == 'admin')
                                            {{-- kondisi button non fungsi karena admin --}}
                                            <div class="row">
                                                <a href="#!" type="button"
                                                    class="btn btn-checklist icon-cart-hover mt-2"
                                                    title="Tambahkan Jasa ke Pesanan?"><i
                                                        class="fa-solid fa-cart-plus"></i>
                                                    &ensp; Add to Order
                                                </a>
                                            </div>
                                            {{-- kondisi jika user customer --}}
                                        @elseif (auth()->user() != null && auth()->user()->role == 'customer')
                                            {{-- mengecek apakah barang ada di pesanan milik customer ada atau tidak --}}
                                            @if (DB::table('order_services')->where('service_id', $value->id)->where('user_id', auth()->user()->id)->exists())
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-2"
                                                        title="Jasa Ada Di Daftar Pesanan"> Jasa Sudah
                                                        Ditambahkan
                                                    </a>
                                                </div>
                                            @else
                                                {{-- jikalau barang tidak ada --}}
                                                <form
                                                    action="{{ route('order.store.service.home', ['user_id' => auth()->user()->id, 'service_id' => $value->id]) }}"
                                                    method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        <button type="submit"
                                                            class="btn btn-checklist icon-cart-hover mt-2"
                                                            title="Tambahkan Jasa ke Pesanan?"><i
                                                                class="fa-solid fa-cart-plus"></i>
                                                            &ensp; Add to Order
                                                        </button>
                                                    </div>
                                                </form>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(".slider").owlCarousel({
            center: false,
            items: 2,
            loop: true,
            margin: 5,
            autoplay: true,
            autoplayTimeout: 3000,
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                },
            }
        });
    </script>
@endsection
