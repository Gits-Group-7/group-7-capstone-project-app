@extends('layouts.customer.template-customer')

@section('title')
    <title>Halaman Detail & Checkout Transaksi Produk | Print-Shop</title>
@endsection

@section('css')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection

@php
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
    <section class="mt-5 beranda-responsive cart-order-responsive pt-2">
        <div class="container">
            <div class="row mb-3">
                <div class="col-xl-8 col-lg-7">
                    <div class="card card-hover px-4 pb-1 mb-4">
                        <h6 class="mb-3 fw-medium mt-4">Daftar Produk di Keranjang</h6>

                        <div class="row justify-content-around">
                            @if (!$cart_products->isEmpty())
                                @foreach ($cart_products as $products)
                                    <div class="col-xl-5 col-lg-12 col-md-12 col-sm-12 col-12 p-3 rounded mb-4 border">
                                        <div class="d-flex align-items-center mb-4">
                                            <div class="me-3 position-relative">
                                                <img src="{{ Storage::url($products->photo) }}"
                                                    class="border rounded me-3 p-2" style="width: 96px; height: 96px;" />
                                            </div>
                                            <div class="">
                                                <span class="nav-link mb-1 text-justify text-muted mb-2">
                                                    {{ $products->name }}
                                                </span>
                                                <div class="price fw-medium">
                                                    <span class="text-theme">
                                                        {{ $products->quantity }} X
                                                    </span>
                                                    <span class="text-theme">
                                                        Rp. {{ priceConversion($products->price) }}
                                                    </span>
                                                </div>
                                                <div class="price fw-medium">
                                                    Total : <span class="text-success">
                                                        Rp. {{ priceConversion($products->total_price) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span class="mb-4 text-muted">*Tidak ada produk di
                                    <a href="{{ route('cart.index') }}" target="_blank" class="fw-medium">Keranjang</a>
                                </span>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 d-flex justify-content-center justify-content-lg-end d-lg-flex">
                    <div class=" ms-lg-4 mt-lg-0 mx-auto" style="max-width: 320px;">

                        <div class="card card-hover p-4">
                            <h6 class="mb-3 fw-medium">Informasi Pembayaran Pesanan</h6>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Harga Checkout :</p>
                                <p class="mb-2 fw-medium">Rp. {{ priceConversion($total_price_cart) }}</p>
                            </div>
                            <div class="d-flex justify-content-between">
                                <p class="mb-2">Ongkos Pengiriman :</p>
                                <p class="mb-2 fw-medium">Rp. {{ priceConversion($deliveryPrice) }}
                                </p>
                            </div>

                            <hr />

                            <div class="d-flex justify-content-between">
                                <p class="mb-2 fw-medium">Total Harga :</p>
                                <p class="mb-2 fw-bold text-success">Rp.
                                    {{ priceConversion($total_price_cart + $deliveryPrice) }}</p>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-lg-7 mb-4">
                    <div class="card shadow-sm card-hover">
                        <div class="p-4">
                            <h6 class="card-title mb-2"><i class="fa-regular fa-credit-card"></i> &ensp; Metode Pembayaran
                            </h6>
                            <p class="text-justify">*Untuk <span class="text-theme fw-medium">Metode
                                    Pembayaran,</span>
                                Anda dapat melakukan
                                pembayaran <span class="text-theme fw-medium">Via Digital</span> dengan menggunakan nomor
                                <span class="text-theme fw-medium">(082-332-743-884)</span>. Tersedia untuk Metode
                                Pembayaran <span class="text-theme fw-medium">Aplikasi Dompet Digital</span> Kesayangan
                                Anda
                                <span class="text-theme fw-medium">(Ovo,
                                    Dana, Go-Pay dan ShopeePay).</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-8 col-lg-7 mb-4">
                    <!-- Checkout -->
                    <div class="card shadow-sm card-hover">
                        <div class="p-4">
                            <h5 class="card-title mb-3">Checkout Transaksi Produk</h5>

                            <form
                                action="{{ route('transaction.order.checkout_transaction_product', $transaction_product->id) }}"
                                method="POST">
                                @method('put')
                                @csrf

                                <div class="row">
                                    <div class="col-sm-12 mb-3">
                                        <label for="order_address" class="mb-2">Alamat Pengiriman <small
                                                class="text-danger">(*wajib)</small></label>
                                        <div class="form-outline">
                                            <textarea class="form-control @error('order_address') is-invalid @enderror" name="order_address" id="order_address"
                                                name="order_address" cols="30" rows="5" placeholder="Tambahkan alamat pengiriman pesanan produk Anda"></textarea>
                                        </div>
                                        @if ($errors->has('order_address'))
                                            <div class="invalid feedback text-danger mb-3">
                                                *form alamat pengiriman wajib di isi
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-sm-12 mb-3">
                                        <label for="order_note" class="mb-2">Catatan Pesanan <small
                                                class="text-primary">(*optional)</small></label>
                                        <div class="form-outline">
                                            <textarea class="form-control" name="order_note" id="order_note" name="order_note" cols="30" rows="3"
                                                placeholder="Tambahkan catatan detail untuk pemesanan produk Anda"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="float-end mt-2">
                                    <a href="{{ route('transaction.order.customer.list') }}"
                                        class="btn btn-unchecklist border">Batal</a>
                                    @if (!$cart_products->isEmpty())
                                        <button class="btn btn-checklist shadow-0 border">Proses Checkout</button>
                                    @endif
                                </div>
                            </form>

                        </div>
                    </div>
                    <!-- Checkout -->
                </div>
            </div>

        </div>
    </section>
@endsection
