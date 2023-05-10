@extends('layouts.customer.template-customer')

@section('title')
    <title>Tentang Toko | Print-Shop</title>
@endsection

@php
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

    {{-- Start Livewire --}}
    <livewire:filter-product-service></livewire:filter-product-service>
    {{-- End Livewire --}}
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
