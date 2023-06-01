@extends('layouts.customer.template-customer')

@section('title')
    <title>Hasil Pencarian Produk dan Jasa | Print-Shop</title>
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
    
    function roundToOneDecimal($number)
    {
        $rounded = round($number, 1); // Bulatkan angka dengan satu angka di belakang koma
        return number_format($rounded, 1); // Format angka dengan satu angka di belakang koma
    }
@endphp

@section('content')
    <!-- content -->
    <section class="mt-2 margin-responsive">
        <div class="container-fluid p-5">
            <div class="row gx-5">

                <div class="col-lg-6 row-item">
                    <div class="alert alert-primary" role="alert">
                        <h3 class="text-center">
                            Produk
                        </h3>
                    </div>

                    <div class="row">
                        @if ($products->isEmpty())
                            <div class="col-12 text-center">
                                *Tidak ada produk yang sesuai dengan pencarian
                            </div>
                        @else
                            @foreach ($products as $product)
                                <div class="item col-6 d-flex justify-content-center p-1">
                                    <div class="card my-2 shadow-sm p-4 card-hover">
                                        <a href="{{ route('customer.product.detail', $product->id) }}" class="img-wrap">
                                            <img src="{{ Storage::url($product->photo) }}" class="card-img-top rounded"
                                                title="{{ $product->name }}">
                                        </a>
                                        <div class="card-body p-0 pt-2">
                                            <h6 class="card-title product-title mt-2 pt-2 limit-text"
                                                title="{{ $product->name }}">
                                                <span class="text-black fw-bold">{{ $product->name }}</span>
                                            </h6>

                                            <div class="product-details">
                                                <div class="row">
                                                    <div class="col d-flex">
                                                        <span class="card-text mx-auto my-auto">
                                                            <span class="text-theme-two fw-bold price-size">Rp.
                                                                {{ priceConversion($product->price) }}</span>
                                                        </span>
                                                    </div>
                                                    <div class="col d-flex">
                                                        <div class="product-rating mx-auto my-auto">
                                                            @php
                                                                $product_id = $product->id;
                                                                $averageRating = $product->product_rating->where('product_id', $product_id)->avg('rating');
                                                                
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
                                                                    $product_id = $product->id;
                                                                    $product_rating = $product->product_rating->where('product_id', $product_id)->first();
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
                                                        @if ($product->status == 'Tersedia')
                                                            <span class="status-available-badge">
                                                                {{ $product->status }}
                                                            </span>
                                                        @elseif ($product->status == 'Pre Order')
                                                            <span class="status-pre-order-badge">
                                                                {{ $product->status }}
                                                            </span>
                                                        @elseif ($product->status == 'Habis')
                                                            <span class="status-run-out-badge">
                                                                {{ $product->status }}
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col bg-danger d-flex">
                                                    <div class="mx-auto my-auto">
                                                        <span
                                                            class="fw-medium text-theme new-badge">{{ $product->condition }}</span>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Pengecekan Product --}}
                                            @if (!Auth::check())
                                                {{-- kondisi jika user masih guest --}}
                                                @if ($product->status == 'Habis' || $product->status == 'Pre Order')
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
                                                @if ($product->status == 'Habis' || $product->status == 'Pre Order')
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
                                                @if ($product->status == 'Habis' || $product->status == 'Pre Order')
                                                    {{-- mengecek status barang --}}
                                                    <div class="row">
                                                        <a href="#!" type="button"
                                                            class="btn btn-checklist-on icon-cart-hover mt-2"
                                                            title="Produk Tidak Tersedia"> Produk Tidak Tersedia
                                                        </a>
                                                    </div>
                                                @else
                                                    {{-- mengecek apakah barang ada di keranjang milik customer ada atau tidak --}}
                                                    @if (DB::table('cart_products')->where('product_id', $product->id)->where('user_id', auth()->user()->id)->exists())
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
                                                            action="{{ route('cart.store.product.home', ['user_id' => auth()->user()->id, 'product_id' => $product->id]) }}"
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
                            @endforeach
                        @endif
                    </div>
                </div>

                <div class="col-lg-6 row-item">
                    <div class="alert alert-primary" role="alert">
                        <h3 class="text-center">
                            Jasa
                        </h3>
                    </div>

                    <div class="row">
                        @if ($services->isEmpty())
                            <div class="col-12 text-center">
                                *Tidak ada jasa yang sesuai dengan pencarian
                            </div>
                        @else
                            @foreach ($services as $service)
                                <div class="item col-6 d-flex justify-content-center p-1">
                                    <div class="card my-2 shadow-sm p-4 card-hover">
                                        <a href="{{ route('customer.service.detail', $service->id) }}" class="img-wrap">
                                            <img src="{{ Storage::url($service->photo) }}" class="card-img-top rounded"
                                                title="{{ $service->name }}">
                                        </a>
                                        <div class="card-body p-0 pt-2">
                                            <h6 class="card-title mt-2 pt-2 limit-text" title="{{ $service->name }}">
                                                <span class="text-black fw-bold">{{ $service->name }}</span>
                                            </h6>

                                            <div class="row">
                                                <div class="col d-flex">
                                                    <span class="card-text mx-auto my-auto">
                                                        <span class="text-theme-two fw-bold price-size">Rp.
                                                            {{ priceConversion($service->price_per_pcs) }}</span>
                                                    </span>
                                                </div>
                                                <div class="col d-flex">
                                                    <div class="product-rating mx-auto my-auto">
                                                        @php
                                                            $service_id = $service->id;
                                                            $averageRating = $service->service_rating->where('service_id', $service_id)->avg('rating');
                                                            
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
                                                                $service_id = $service->id;
                                                                $service_rating = $service->service_rating->where('service_id', $service_id)->first();
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
                                                            class="fw-medium text-theme new-badge">{{ $service->estimation }}
                                                            Hari</span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row justify-content-between my-2">
                                                <div class="col-6 d-flex">
                                                    <span class="status-available-badge">
                                                        {{ $service->category->name }}
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
                                                @if (DB::table('order_services')->where('service_id', $service->id)->where('user_id', auth()->user()->id)->exists())
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
                                                        action="{{ route('order.store.service.home', ['user_id' => auth()->user()->id, 'service_id' => $service->id]) }}"
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
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- content -->
@endsection
