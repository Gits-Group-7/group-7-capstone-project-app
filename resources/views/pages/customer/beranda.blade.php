@extends('layouts.customer.template-customer')

@section('title')
    <title>Selamat datang di Print-Shop | Online Shop Outfit Terbaik!</title>
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
    
    function roundToOneDecimal($number)
    {
        $rounded = round($number, 1); // Bulatkan angka dengan satu angka di belakang koma
        return number_format($rounded, 1); // Format angka dengan satu angka di belakang koma
    }
@endphp

@section('content')
    <!--  intro  -->
    <section class="mt-5 beranda-responsive">
        <div class="container">
            <main class="card p-3 shadow-2-strong">
                <div class="row">
                    <div class="col-sm-12 col-lg-12 col-xl-4 d-flex mb-3">
                        <div class="card-banner h-auto p-5 bg-theme rounded-5" style="height: 350px;">
                            <div>
                                <h4 class="text-white">
                                    Selamat datang di<br>Print-Shop! 🥰<br />
                                </h4>
                                {{-- <img src="{{ asset('admin/images/welcome-image.svg') }}" class="img-fluid" alt=""> --}}
                                <p class="text-white text-justify mt-3">
                                    &ensp;&ensp;&ensp;&ensp;Selamat datang, Temukan berbagai pilihan baju dan
                                    outfit berkualitas terbaik dengan harga terjangkau hanya di Print Shop, toko online
                                    terpercaya untuk layanan sablon dan custom.
                                </p>
                                <center>
                                    <a href="#search-input" class="btn btn-theme shadow-0 mt-3">Temukan Produk & Jasa
                                        Menarik</a>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-lg-12 col-xl-8">
                        <div id="carouselExampleIndicators" class="carousel slide" data-mdb-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('customer/images/banner/promo-banner-default.png') }}"
                                        class="d-block w-100 rounded" alt="" title="Welcome Banner" />
                                </div>
                                @foreach ($promo_banners as $item)
                                    <div class="carousel-item">
                                        <img src="{{ Storage::url($item->photo) }}" class="d-block w-100 rounded"
                                            alt="" title="{{ $item->title }}" />
                                    </div>
                                @endforeach
                            </div>
                            <button class="carousel-control-prev" type="button"
                                data-mdb-target="#carouselExampleIndicators" data-mdb-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-mdb-target="#carouselExampleIndicators" data-mdb-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <!-- container end.// -->
    </section>
    <!-- intro -->

    {{-- banner katalog produk --}}
    <section>
        <div class="container mt-5">
            <div class="row d-flex">
                <div class="col-12 my-auto">
                    <div class="alert bg-theme text-white" role="alert">
                        <h3 class="text-center">KATALOG PRODUK</h3>
                    </div>
                </div>
            </div>
    </section>

    {{-- katalog produk --}}
    <section id="produk">
        {{-- diynamic content product --}}
        @foreach ($categories_products as $item)
            @if ($item->category->status == 'Aktif')
                <section id="{{ underscore($item->category->name) }}">
                    <div class="container my-5">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="alert alert-primary" role="alert">
                                    <h3 class="text-center">{{ $item->category->name }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="slider owl-carousel owl-theme">

                                @foreach ($products as $value)
                                    @if ($item->category_id == $value->category_id)
                                        <div class="item col-md-12 d-flex justify-content-center p-1">
                                            <div class="card my-2 shadow-sm p-4 card-hover">
                                                <a href="{{ route('customer.product.detail', $value->id) }}"
                                                    class="img-wrap">
                                                    <img src="{{ Storage::url($value->photo) }}"
                                                        class="card-img-top rounded" title="{{ $value->name }}"
                                                        style="aspect-ratio: 1 / 1">
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
                                    @endif
                                @endforeach

                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
    </section>

    {{-- banner katalog jasa --}}
    <section>
        <div class="container mt-5">
            <div class="row d-flex">
                <div class="col-12 my-auto">
                    <div class="alert bg-theme-two text-white" role="alert">
                        <h3 class="text-center">KATALOG JASA</h3>
                    </div>
                </div>
            </div>
    </section>

    {{-- katalog jasa --}}
    <section id="jasa">
        {{-- diynamic content product --}}
        @foreach ($categories_services as $item)
            @if ($item->category->status == 'Aktif')
                <section id="{{ underscore($item->category->name) }}">
                    <div class="container my-5">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="alert alert-primary" role="alert">
                                    <h3 class="text-center">{{ $item->category->name }}</h3>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="slider owl-carousel owl-theme">

                                @foreach ($services as $value)
                                    @if ($item->category_id == $value->category_id)
                                        <div class="item col-md-12 d-flex justify-content-center p-1">
                                            <div class="card my-2 shadow-sm p-4 card-hover">
                                                <a href="{{ route('customer.service.detail', $value->id) }}"
                                                    class="img-wrap">
                                                    <img src="{{ Storage::url($value->photo) }}"
                                                        class="card-img-top rounded" title="{{ $value->name }}"
                                                        style="aspect-ratio: 1 / 1">
                                                </a>
                                                <div class="card-body p-0 pt-2">
                                                    <h6 class="card-title mt-2 pt-2 limit-text"
                                                        title="{{ $value->name }}">
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
                                                                    class="fw-medium text-theme new-badge">{{ $value->estimation }}
                                                                    Hari</span>
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
            @endif
        @endforeach
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
