@extends('layouts.customer.template-customer')

@section('title')
    <title>Daftar Produk Keranjang | Gadget Web Store</title>
@endsection

@section('css')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
@endsection

@php
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
    <section class="my-5">
        <div class="container">
            <div class="row">
                <!-- cart -->
                <div class="col-lg-9 mb-4">
                    <div class="card border shadow-sm card-hover">
                        <div class="m-4">
                            <div class="row d-flex justify-content-between">
                                <div class="col-sm-5 d-flex">
                                    <div class="mx-auto">
                                        <h4 class="card-title mb-4 alert alert-primary mt-3">Daftar Produk Keranjang</h4>
                                    </div>
                                </div>
                                <div class="col-sm-4 d-flex">
                                    <div class="mx-auto my-auto">
                                        <div class="mt-3">
                                            <a href="{{ route('transaction.index') }}"
                                                class="btn btn-checklist w-100 shadow-0 mb-2">Daftar
                                                Transaksi Saya</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (DB::table('carts')->count())
                                @foreach ($cart_products as $item)
                                    <div class="row gy-3 mb-4">
                                        <div class="col-lg-7">
                                            <div class="me-lg-5">
                                                <div class="d-flex pt-3">
                                                    <img src="{{ Storage::url($item->photo) }}"
                                                        class="border rounded me-3 p-2"
                                                        style="width: 96px; height: 96px;" />
                                                    <div class="">
                                                        <a href="#"
                                                            class="nav-link pt-2 fw-bold">{{ $item->name }}</a>
                                                        <span class="text-muted">
                                                            Kategori :
                                                            @foreach ($category_name as $value)
                                                                @if ($item->product_id == $value->id)
                                                                    {{ $value->category->name }}
                                                                @endif
                                                            @endforeach
                                                        </span><br>
                                                        <span class="text-muted">Kondisi : {{ $item->condition }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-5 d-flex">
                                            <div class="row mx-auto">
                                                <div class="col">
                                                    <div class="pt-2">
                                                        <small class="text-muted text-nowrap"> Rp.
                                                            {{ priceConversion($item->price) }} /
                                                            per item
                                                        </small> <br>
                                                        <span class="h6 fw-bold">
                                                            Total :<br>
                                                            Rp. {{ priceConversion($item->total_price) }}
                                                        </span>

                                                        {{-- manage cart --}}
                                                        <form action="{{ route('cart.update', $item->id) }}" method="POST">
                                                            @method('put')
                                                            @csrf

                                                            <div class="form-group">
                                                                <input type="number" class="form-control mt-3"
                                                                    id="quantity" name="quantity"
                                                                    value="{{ $item->quantity }}" min="1"
                                                                    max="99">
                                                            </div>
                                                            {{-- </form> --}}
                                                    </div>
                                                </div>

                                                <div class="col d-flex">
                                                    <div class="float-md-start my-auto">
                                                        <button type="submit" class="btn btn-checklist px-2">
                                                            <i class="fa-solid fa-check fa-lg px-1"></i>
                                                        </button>
                                                        </form>

                                                        <a href="{{ route('cart.delete', $item->id) }}"
                                                            class="btn btn-delete px-2">
                                                            <i class="fa-solid fa-trash fa-lg px-1"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <span>
                                    Silahkan tambahkan data produk terlebih dahulu.
                                    <a href="{{ route('customer.beranda') }}">Beranda</a>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- cart -->

                <!-- summary -->
                <div class="col-lg-3">
                    <div class="card shadow-sm border card-hover">
                        <div class="card-body">
                            <div class="card-title">
                                <span class="fw-bold">Daftar Produk Cart :</span>
                            </div>

                            @if (DB::table('carts')->count())
                                <ul>
                                    @foreach ($cart_products as $item)
                                        <li>
                                            <p class="mb-2">
                                                <span class="limit-text-title fw-medium" title="{{ $item->name }}">
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
                                <p class="mb-2 fw-bold">Total :</p>
                                <p class="mb-2 fw-bold">Rp. {{ priceConversion($total_price_cart) }}</p>
                            </div>

                            @if (DB::table('carts')->count())
                                @if (DB::table('transactions')->count())
                                    @if ($last_transaction->status == 'Success Order')
                                        <div class="mt-3">
                                            <button type="submit" class="btn btn-checklist w-100 shadow-0 mb-2"
                                                data-bs-toggle="modal" data-bs-target="#exampleModal">Beli Sekarang</button>
                                        </div>
                                    @else
                                        <div class="mt-3">
                                            <a href="{{ route('transaction.index') }}" type="button"
                                                class="btn btn-checklist w-100 shadow-0 mb-2">Selesaikan Proses
                                                Transaksi</a>
                                        </div>
                                    @endif
                                @else
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-checklist w-100 shadow-0 mb-2"
                                            data-bs-toggle="modal" data-bs-target="#exampleModal">Beli Sekarang</button>
                                    </div>
                                @endif
                            @else
                                <div class="mt-3">
                                    <a href="{{ route('customer.beranda') }}" type="submit"
                                        class="btn btn-checklist w-100 shadow-0 mb-2">Mohon Tambahkan Produk</a>
                                </div>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Tambah Transaksi?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        {{-- <div class="modal-body"></div> --}}
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-unconfirm"
                                                data-bs-dismiss="modal">Batal</button>
                                            <a href="{{ route('transaction.store') }}" type="button"
                                                class="btn btn-confirm">Oke</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- summary -->
            </div>
        </div>
    </section>

    <section>
        <div class="container my-4">
            <div class="row">
                <div class="slider owl-carousel owl-theme">
                    @foreach ($products as $value)
                        <form action="{{ route('cart.store', $value->id) }}" method="POST">
                            @csrf

                            <div class="item col-md-12 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="#!" class="img-wrap">
                                        <img src="{{ Storage::url($value->photo) }}" class="card-img-top rounded"
                                            title="{{ $value->name }}" style="aspect-ratio: 1 / 1">
                                    </a>
                                    <div class="card-body p-0 pt-2">
                                        <h6 class="card-title mt-2 pt-2 limit-text" title="{{ $value->name }}">
                                            <span class="text-black fw-bold">{{ $value->name }}</span>
                                        </h6>

                                        <div class="row justify-content-between my-2">
                                            <div class="col-6 d-flex">
                                                <span class="card-text">
                                                    <span class="text-theme-two fw-bold">Rp.
                                                        {{ priceConversion($value->price) }}</span>
                                                    <br>
                                                    <span class="fw-medium text-theme">{{ $value->condition }}</span>
                                                </span>
                                            </div>

                                            <div class="col-6 d-flex">
                                                @if ($value->status == 'Tersedia')
                                                    <div class="btn ready-content my-auto mx-auto">
                                                        {{ $value->status }}
                                                    </div>
                                                @elseif ($value->status == 'Pre Order')
                                                    <div class="btn pre-order-content my-auto mx-auto">
                                                        {{ $value->status }}
                                                    </div>
                                                @elseif ($value->status == 'Habis')
                                                    <div class="btn run-out-content my-auto mx-auto">
                                                        {{ $value->status }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    @if ($carts->contains('product_id', $value->id))
                                        <a href="#!" type="button"
                                            class="btn btn-checklist-on icon-cart-hover mt-2"
                                            title="Produk ada di keranjang"> On My Cart
                                        </a>
                                    @else
                                        @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                            <a href="#!" type="button"
                                                class="btn btn-checklist-on icon-cart-hover mt-2"
                                                title="Produk ada di keranjang"> Product Unavailable
                                            </a>
                                        @else
                                            <button type="submit" class="btn btn-checklist icon-cart-hover mt-2"
                                                title="Tambah ke keranjang?"> ADD TO CART
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>
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
