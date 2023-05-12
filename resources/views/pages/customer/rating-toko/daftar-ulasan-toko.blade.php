@extends('layouts.customer.template-customer')

@section('title')
    <title>Daftar Ulasan Rating Toko | Print-Shop</title>
@endsection

@php
    // fungsi konversi data tipe date ke tanggal
    function dateConversion($date)
    {
        $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $slug = explode('-', $date);
        return $slug[2] . ' ' . $month[(int) $slug[1]] . ' ' . $slug[0];
    }
    
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
                <h6>Total Ulasan : {{ $rating_count }}</h6>
            </div>

            <div class="row">
                @foreach ($ratings as $item)
                    <div class="col-lg-6 mb-2">
                        <div id="rating-user" class="card border card-hover my-3">
                            <div class="card-body m-3">
                                <div class="row align-items-center">
                                    <div class="col-md-4 col-12 mb-3 mb-md-0">
                                        <img src="{{ Storage::url($item->user->photo) }}" alt=""
                                            class="img-thumbnail rounded-circle">
                                    </div>
                                    <div class="col-md-8 col-12">
                                        <h5 class="mb-0">{{ $item->user->name }}</h5>
                                        <p class="small text-secondary mb-2">{{ dateConversion($item->rating_date) }}</p>

                                        <div class="product-rating mt-1">
                                            @if ($item->rating >= 1)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                            @if ($item->rating >= 2)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                            @if ($item->rating >= 3)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                            @if ($item->rating >= 4)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                            @if ($item->rating >= 5)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class="fa fa-star-o"></i>
                                            @endif
                                        </div>

                                        <p id="comment-rating" class="mt-3 mb-0 text-secondary small">
                                            @if (!$item->comment == '')
                                                {{ $item->comment }}
                                            @else
                                                <i>"Customer ini tidak mendeskripsikan ulasan"</i>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="d-flex justify-content-center">
                    {{ $ratings->links() }}
                </div>
            </div>

        </div>
    </section>
@endsection
