@extends('layouts.customer.template-customer')

@section('title')
    <title>Tentang Toko | Print-Shop</title>
@endsection

@php
    function convertToTitleCase($string)
    {
        return ucfirst($string);
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
    <section class="mt-5">
        <div class="container">
            <div class="row">
                <!-- dashboard toko -->
                <div class="col-lg-12 mb-4">
                    <div class="card border shadow-sm card-hover">
                        <div class="m-4">
                            <div class="row d-flex justify-content-between px-3">
                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 d-flex mb-3">
                                    <div class="mx-auto">
                                        <img src="{{ asset('admin/images/print-shop-store-logo.png') }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                </div>
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-6 d-flex mb-3">
                                    <div class="my-auto mx-auto text-store">
                                        <h2 class="fw-bold text-theme">Print-Shop</h2>
                                        <div class="product-rating mx-auto my-auto">
                                            Rating :
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <span class="rating-number fw-medium text-theme">(5)</span>
                                        </div>
                                        <br>
                                        <i class="fa-solid fa-clock text-theme"></i> 09.00 WIB - 18.00 WIB
                                        <br>
                                        <i class="fa-solid fa-bag-shopping text-theme"></i> Menawarkan Produk & Layanan Jasa
                                        <br>
                                        <i class="fa-solid fa-location-dot text-theme"></i> Jln Raya Jember, Kabat -
                                        Banyuwangi
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 d-flex mb-3">
                                    <div class="my-auto text-store">
                                        <h3 class="fw-medium">
                                            <span class="text-theme">Tentang Toko</span>
                                        </h3>
                                        <p class="text-secondary text-justify">
                                            Print-Shop menyediakan produk baju berkualitas terbaik dengan
                                            harga
                                            terjangkau
                                            serta jasa konveksi baju, sablon, dan bordir dengan tim profesional untuk
                                            memuaskan kebutuhan pelanggan.
                                        </p>
                                        <div class="d-flex justify-content-end">
                                            <div class="py-2">
                                                <a href="#!" class="btn btn-chat"><i class="fa-solid fa-message"></i>
                                                    &ensp; Contact Admin</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- dashboard toko -->
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row justify-content-around">

                {{-- konten navigasi katalog dan rating --}}
                <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-3">
                    <div class="card border shadow-sm card-hover">
                        <div class="m-4">
                            <div class="form-group">
                                <label class="mb-2 fw-medium" for="filter">Filter Produk & Jasa</label>
                                <select class="form-control" id="filter" name="filter">
                                    <option value="">Pilih Kategori Produk atau Jasa</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}"> [{{ convertToTitleCase($item->type) }}]
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- recent rating --}}
                            <label class="mt-4 fw-medium" for="filter">Latest Customer Rating</label>

                            <div id="rating-user" class="card border card-hover my-3">
                                <div class="card-body m-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('customer/images/profile-customer.png') }}" alt=""
                                                class="img-thumbnail rounded-circle">
                                        </div>
                                        <div class="col-8">
                                            Taufik Hidayat<br>
                                            8 Mei 2023 <br>

                                            <div class="product-rating mt-1">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p id="comment-rating" class="text-justify mt-3">Toko ini sangat saya
                                                rekomendasikan untuk pelanggan
                                                yang
                                                memiliki usaha konveksi.
                                                Mantap deh pokoknya!!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="rating-user" class="card border card-hover my-3">
                                <div class="card-body m-3">
                                    <div class="row">
                                        <div class="col-4">
                                            <img src="{{ asset('customer/images/profile-customer.png') }}" alt=""
                                                class="img-thumbnail rounded-circle">
                                        </div>
                                        <div class="col-8">
                                            Taufik Hidayat<br>
                                            8 Mei 2023 <br>

                                            <div class="product-rating mt-1">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <p id="comment-rating" class="text-justify mt-3">Toko ini sangat saya
                                                rekomendasikan untuk pelanggan
                                                yang
                                                memiliki usaha konveksi.
                                                Mantap deh pokoknya!!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12 mb-3">
                                    <button type="button" class="btn btn-block btn-rating" data-bs-toggle="modal"
                                        data-bs-target="#kt_modal_stacked_1">
                                        Tulis Rating Toko
                                    </button>
                                </div>

                                {{-- Modal Rating --}}
                                <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Rating Toko <span
                                                        class="fw-medium">"Print-Shop"</span></h5>

                                                <!--begin::Close-->
                                                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="ki-duotone ki-cross fs-1"><span class="path1"></span><span
                                                            class="path2"></span></i>
                                                </div>
                                                <!--end::Close-->
                                            </div>

                                            <div class="modal-body">
                                                <div class="form-group mx-3 mb-4">
                                                    <label for="rating" class="fw-medium mb-2">Berapa Rating Anda untuk
                                                        Toko Ini</label>

                                                    <div class="rating d-flex justify-content-around my-2">
                                                        <div class="">
                                                            <!--begin::Star 1-->
                                                            <label class="rating-label" for="kt_rating_input_1">
                                                                <i class="fa-solid fa-star star-rating"></i>
                                                            </label>
                                                            <input class="rating-input" name="rating" value="1"
                                                                type="radio" id="kt_rating_input_1" />
                                                            <!--end::Star 1-->
                                                        </div>

                                                        <div class="">
                                                            <!--begin::Star 2-->
                                                            <label class="rating-label" for="kt_rating_input_2">
                                                                <i class="fa-solid fa-star star-rating"></i>
                                                            </label>
                                                            <input class="rating-input" name="rating" value="2"
                                                                type="radio" id="kt_rating_input_2" name="rating" />
                                                            <!--end::Star 2-->
                                                        </div>

                                                        <div class="">
                                                            <!--begin::Star 3-->
                                                            <label class="rating-label" for="kt_rating_input_3">
                                                                <i class="fa-solid fa-star star-rating"></i>
                                                            </label>
                                                            <input class="rating-input" name="rating" value="3"
                                                                type="radio" id="kt_rating_input_3" name="rating" />
                                                            <!--end::Star 3-->
                                                        </div>

                                                        <div class="">
                                                            <!--begin::Star 4-->
                                                            <label class="rating-label" for="kt_rating_input_4">
                                                                <i class="fa-solid fa-star star-rating"></i>
                                                            </label>
                                                            <input class="rating-input" name="rating" value="4"
                                                                type="radio" id="kt_rating_input_4" name="rating" />
                                                            <!--end::Star 4-->
                                                        </div>

                                                        <div class="">
                                                            <!--begin::Star 5-->
                                                            <label class="rating-label" for="kt_rating_input_5">
                                                                <i class="fa-solid fa-star star-rating"></i>
                                                            </label>
                                                            <input class="rating-input" name="rating" value="5"
                                                                type="radio" id="kt_rating_input_5" name="rating" />
                                                            <!--end::Star 5-->
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-group m-3">
                                                    <label for="comment" class="fw-medium mb-2">Komentar Rating</label>
                                                    <textarea class="form-control" id="comment" rows="4" name="comment"
                                                        placeholder="Berikan Komentar Positif pada Toko kami"></textarea>
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-unconfirm"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ route('customer.store.rating') }}" type="button" class="btn btn-confirm">Tambah
                                                    Ulasan</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <a href="{{ route('customer.store.rating') }}" class="btn btn-block btn-chat">Lihat
                                        Ulasan Toko</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- list katalog produk --}}
                <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 mb-3" id="product-service">
                    <div class="row justify-content-around">

                        {{-- katalog produk --}}
                        @foreach ($products as $value)
                            <div class="item col-6 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="#!" class="img-wrap">
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
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-half"></i>
                                                        <span class="rating-number fw-medium text-theme">(4.5)</span>
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

                                        @if ($carts->contains('product_id', $value->id))
                                            <div class="row">
                                                <a href="#!" type="button"
                                                    class="btn btn-checklist-on icon-cart-hover mt-3"
                                                    title="Produk ada di keranjang"> On My Cart
                                                </a>
                                            </div>
                                        @else
                                            @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-3"
                                                        title="Produk ada di keranjang"> Product
                                                        Unavailable
                                                    </a>
                                                </div>
                                            @else
                                                <form action="{{ route('cart.store', $value->id) }}" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        <button type="submit"
                                                            class="btn btn-checklist icon-cart-hover mt-3"
                                                            title="Tambah ke keranjang?"><i
                                                                class="fa-solid fa-cart-plus"></i>
                                                            &ensp; ADD TO
                                                            CART
                                                        </button>
                                                    </div>

                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        {{-- katalog jasa --}}
                        @foreach ($services as $value)
                            <div class="item col-6 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="#!" class="img-wrap">
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
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star"></i>
                                                    <i class="fa fa-star-half"></i>
                                                    <span class="rating-number fw-medium text-theme">(4.5)</span>
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

                                        @if ($carts->contains('product_id', $value->id))
                                            <div class="row">
                                                <a href="#!" type="button"
                                                    class="btn btn-checklist-on icon-cart-hover mt-3"
                                                    title="Produk ada di keranjang"> On My Cart
                                                </a>
                                            </div>
                                        @else
                                            @if ($value->status == 'Habis' || $value->status == 'Pre Order')
                                                <div class="row">
                                                    <a href="#!" type="button"
                                                        class="btn btn-checklist-on icon-cart-hover mt-3"
                                                        title="Produk ada di keranjang"> Product
                                                        Unavailable
                                                    </a>
                                                </div>
                                            @else
                                                <form action="{{ route('cart.store', $value->id) }}" method="POST">
                                                    @csrf

                                                    <div class="row">
                                                        <button type="submit"
                                                            class="btn btn-checklist icon-cart-hover mt-2"
                                                            title="Order Jasa?"><i class="fa-solid fa-cart-plus"></i>
                                                            &ensp; ADD TO CART
                                                        </button>
                                                    </div>

                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        const ratingInputs = document.querySelectorAll('.rating-input');

        ratingInputs.forEach(ratingInput => {
            ratingInput.addEventListener('change', () => {
                const currentRating = ratingInput.value;
                const starLabels = ratingInput.parentNode.parentNode.querySelectorAll('.rating-label i');

                starLabels.forEach((starLabel, index) => {
                    if (index < currentRating) {
                        starLabel.classList.add('checked');
                    } else {
                        starLabel.classList.remove('checked');
                    }
                });
            });
        });
    </script>
@endsection
