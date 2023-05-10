@extends('layouts.customer.template-customer')

@section('title')
    <title>Daftar Ulasan Rating Toko | Print-Shop</title>
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
                <div class="col-12">
                    <div class="alert alert-primary" role="alert">
                        <h3 class="text-center">Daftar Ulasan Rating Toko oleh Customer</h3>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6 mb-2">
                    <div id="rating-user" class="card border card-hover my-3">
                        <div class="card-body m-3">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-12 mb-3 mb-md-0">
                                    <img src="{{ asset('customer/images/profile-customer.png') }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>
                                <div class="col-md-8 col-12">
                                    <h5 class="mb-0">Taufik Hidayat</h5>
                                    <p class="small text-secondary mb-2">8 Mei 2023</p>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p id="comment-rating" class="mt-3 mb-0 text-secondary small">Toko ini sangat saya
                                        rekomendasikan untuk pelanggan yang memiliki usaha konveksi. Mantap deh pokoknya!!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-2">
                    <div id="rating-user" class="card border card-hover my-3">
                        <div class="card-body m-3">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-12 mb-3 mb-md-0">
                                    <img src="{{ asset('customer/images/profile-customer.png') }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>
                                <div class="col-md-8 col-12">
                                    <h5 class="mb-0">Taufik Hidayat</h5>
                                    <p class="small text-secondary mb-2">8 Mei 2023</p>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p id="comment-rating" class="mt-3 mb-0 text-secondary small">Toko ini sangat saya
                                        rekomendasikan untuk pelanggan yang memiliki usaha konveksi. Mantap deh pokoknya!!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 mb-2">
                    <div id="rating-user" class="card border card-hover my-3">
                        <div class="card-body m-3">
                            <div class="row align-items-center">
                                <div class="col-md-4 col-12 mb-3 mb-md-0">
                                    <img src="{{ asset('customer/images/profile-customer.png') }}" alt=""
                                        class="img-thumbnail rounded-circle">
                                </div>
                                <div class="col-md-8 col-12">
                                    <h5 class="mb-0">Taufik Hidayat</h5>
                                    <p class="small text-secondary mb-2">8 Mei 2023</p>
                                    <div class="product-rating">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <p id="comment-rating" class="mt-3 mb-0 text-secondary small">Toko ini sangat saya
                                        rekomendasikan untuk pelanggan yang memiliki usaha konveksi. Mantap deh pokoknya!!
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
@endsection
