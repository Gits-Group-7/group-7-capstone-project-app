@extends('layouts.customer.template-customer')

@section('title')
    <title>Detail Produk - {{ $product->name }} | Print-Shop</title>
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
    <!-- content -->
    <section class="mt-5 beranda-responsive">
        <div class="container">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="rounded-4 mb-3 d-flex justify-content-center card card-hover p-4">
                        <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                            src="{{ Storage::url($product->photo) }}" title="{{ $product->name }}" />
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="card rounded card-hover p-4">
                        <div class="ps-lg-3">
                            <h4 class="title text-dark">
                                {{ $product->name }}
                            </h4>
                            <div class="d-flex flex-row my-3 justify-content-start">
                                <div class="mb-1 me-2">
                                    @php
                                        $product_id = $product->id;
                                        $averageRating = $product->product_rating->where('product_id', $product_id)->avg('rating');
                                        
                                        $rating = $averageRating;
                                        $whole = floor($rating);
                                        $fraction = $rating - $whole;
                                    @endphp

                                    <div class="product-rating mt-1">
                                        @for ($i = 0; $i < $whole; $i++)
                                            <i class="fa fa-star star-rating checked"></i>
                                        @endfor
                                        @if ($fraction > 0)
                                            <i class="fas fa-star-half-stroke star-rating checked"></i>
                                        @endif

                                        <span class="ms-1 fs-20 fw-bold">( {{ $rating_product_count }} Reviews )</span>
                                    </div>

                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex">
                                    <h4 class="fw-bold fs-30">Rp. {{ priceConversion($product->price) }}
                                    </h4>
                                </div>
                            </div>

                            <p class="text-secondary text-justify">
                                {{ $product->description }}
                            </p>

                            <div class="row mb-2">

                                <div class="col-md-4 col-6 mb-2">
                                    <label class="mb-2 d-block fw-medium" for="quantity">Jumlah</label>
                                    <div class="input-group mb-3" style="width: 170px;">
                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                            id="btn-minus" data-mdb-ripple-color="dark">
                                            <i class="fa-solid fa-minus"></i>
                                        </button>

                                        <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                            @csrf

                                            <input type="text" name="quantity" id="quantity"
                                                class="form-control text-center border border-secondary" placeholder="1"
                                                min="1" aria-label="Example text with button addon"
                                                aria-describedby="button-addon1" value="1" />
                                        </form>

                                        <button class="btn btn-white border border-secondary px-3" type="button"
                                            id="btn-plus" data-mdb-ripple-color="dark">
                                            <i class="fa-solid fa-plus"></i>
                                        </button>

                                    </div>
                                </div>

                                {{-- script untuk memfungsikan tombol quantity --}}
                                <script>
                                    // Get the buttons and input element
                                    const btnMinus = document.getElementById('btn-minus');
                                    const btnPlus = document.getElementById('btn-plus');
                                    const inputQuantity = document.getElementById('quantity');

                                    // Add event listener to minus button
                                    btnMinus.addEventListener('click', () => {
                                        let quantity = parseInt(inputQuantity.value);
                                        if (quantity > 1) {
                                            quantity--;
                                            inputQuantity.value = quantity;
                                        }
                                    });

                                    // Add event listener to plus button
                                    btnPlus.addEventListener('click', () => {
                                        let quantity = parseInt(inputQuantity.value);
                                        quantity++;
                                        inputQuantity.value = quantity;
                                    });
                                </script>

                                <div class="col-md-6 col-6 d-flex">
                                    <div class="my-auto mx-auto">
                                        @if ($carts->contains('product_id', $product->id))
                                            <a href="{{ route('cart.index') }}" class="btn btn-theme shadow-0"> <i
                                                    class="fa-solid fa-cart-shopping"></i> &ensp;
                                                On My Cart </a>
                                        @elseif ($product->status == 'Habis' || $product->status == 'Pre Order')
                                            <a href="#!" class="btn btn-block btn-theme shadow-0">
                                                <i class="fa-solid fa-ban"></i> &ensp;
                                                Product Unavailable
                                            </a>
                                        @else
                                            <form action="{{ route('cart.store', $product->id) }}" method="POST">
                                                @csrf

                                                <button type="submit" class="btn btn-theme shadow-0"> <i
                                                        class="fa-solid fa-cart-plus"></i>
                                                    &ensp;
                                                    Add to cart </button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <hr />
                            <div class="row mt-3">
                                <dt class="col-3">Kategori :</dt>
                                <dd class="col-9 text-theme">{{ $product->category->name }}</dd>

                                <dt class="col-3">Kondisi :</dt>
                                <dd class="col-9 text-theme">{{ $product->condition }}</dd>

                                <dt class="col-3">Stok :</dt>
                                <dd class="col-9 text-theme">{{ $product->stock }}</dd>

                                <dt class="col-3">Status :</dt>
                                <dd class="col-9 text-theme">{{ $product->status }}</dd>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    </section>
    <!-- content -->

    <section class=" py-4">
        <div class="container">
            <div class="row gx-4">
                <div class="col-lg-8 mb-4">

                    <div class="card rounded-2 bg-white">
                        <div class="card-header px-3 py-2" id="seller-profile-heading">
                            <button class="btn btn-chat text-dark d-flex align-items-center justify-content-center w-100"
                                type="button" data-mdb-toggle="collapse" data-mdb-target="#seller-profile-collapse"
                                aria-expanded="true" aria-controls="seller-profile-collapse">
                                Lihat Ulasan Produk &ensp; <i class="fa-solid fa-caret-down"></i>
                            </button>
                        </div>

                        <div id="seller-profile-collapse" class="collapse" aria-labelledby="seller-profile-heading"
                            data-parent="#ex1">

                            <div class="row justify-content-center pb-4">
                                @auth
                                    @if (Auth::user()->role == 'customer')
                                        <div class="col-10 mt-4">
                                            <button type="button" class="btn btn-block btn-rating" data-bs-toggle="modal"
                                                data-bs-target="#kt_modal_stacked_1">
                                                Tulis Rating Produk ({{ $product->name }})
                                            </button>

                                            {{-- Modal Rating --}}
                                            <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Ulasan Produk</h5>

                                                            <!--begin::Close-->
                                                            <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                                                                data-bs-dismiss="modal" aria-label="Close">
                                                                <i class="ki-duotone ki-cross fs-1"><span
                                                                        class="path1"></span><span class="path2"></span></i>
                                                            </div>
                                                            <!--end::Close-->
                                                        </div>

                                                        <div class="modal-body">
                                                            <form
                                                                action="{{ route('customer.rating.product', ['product_id' => $product->id, 'user_id' => Auth::user()->id]) }}"
                                                                method="POST">
                                                                @csrf

                                                                <div class="form-group mx-3 mb-4">
                                                                    <label for="rating" class="fw-medium mb-2">Berapa Rating
                                                                        Anda
                                                                        untuk
                                                                        Produk Ini</label>

                                                                    <div class="rating d-flex justify-content-around my-2">
                                                                        <div class="">
                                                                            <!--begin::Star 1-->
                                                                            <label class="rating-label"
                                                                                for="kt_rating_input_1">
                                                                                <i class="fa-solid fa-star star-rating"></i>
                                                                            </label>
                                                                            <input class="rating-input" name="rating"
                                                                                value="1" type="radio"
                                                                                id="kt_rating_input_1" />
                                                                            <!--end::Star 1-->
                                                                        </div>

                                                                        <div class="">
                                                                            <!--begin::Star 2-->
                                                                            <label class="rating-label"
                                                                                for="kt_rating_input_2">
                                                                                <i class="fa-solid fa-star star-rating"></i>
                                                                            </label>
                                                                            <input class="rating-input" name="rating"
                                                                                value="2" type="radio"
                                                                                id="kt_rating_input_2" name="rating" />
                                                                            <!--end::Star 2-->
                                                                        </div>

                                                                        <div class="">
                                                                            <!--begin::Star 3-->
                                                                            <label class="rating-label"
                                                                                for="kt_rating_input_3">
                                                                                <i class="fa-solid fa-star star-rating"></i>
                                                                            </label>
                                                                            <input class="rating-input" name="rating"
                                                                                value="3" type="radio"
                                                                                id="kt_rating_input_3" name="rating" />
                                                                            <!--end::Star 3-->
                                                                        </div>

                                                                        <div class="">
                                                                            <!--begin::Star 4-->
                                                                            <label class="rating-label"
                                                                                for="kt_rating_input_4">
                                                                                <i class="fa-solid fa-star star-rating"></i>
                                                                            </label>
                                                                            <input class="rating-input" name="rating"
                                                                                value="4" type="radio"
                                                                                id="kt_rating_input_4" name="rating" />
                                                                            <!--end::Star 4-->
                                                                        </div>

                                                                        <div class="">
                                                                            <!--begin::Star 5-->
                                                                            <label class="rating-label"
                                                                                for="kt_rating_input_5">
                                                                                <i class="fa-solid fa-star star-rating"></i>
                                                                            </label>
                                                                            <input class="rating-input" name="rating"
                                                                                value="5" type="radio"
                                                                                id="kt_rating_input_5" name="rating" />
                                                                            <!--end::Star 5-->
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                                <div class="form-group m-3">
                                                                    <label for="comment" class="fw-medium mb-2">Komentar
                                                                        Ulasan</label>
                                                                    <textarea class="form-control" id="comment" rows="4" name="comment"
                                                                        placeholder="Berikan ulasan positif pada Produk kami"></textarea>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-unconfirm"
                                                                        data-bs-dismiss="modal">Batal</button>
                                                                    <button type="submit" class="btn btn-confirm">Tambah
                                                                        Ulasan</button>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endauth

                                @if ($ratings->isEmpty())
                                    <div class="col-10 mt-4">
                                        <span class="text-secondary">*Ulasan produk ini belum ditambahkan</span>
                                    </div>
                                @else
                                    @foreach ($ratings as $item)
                                        <div class="col-10 mt-4">
                                            <div id="rating-user" class="card border">
                                                <div class="card-body m-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 col-12 mb-3 mb-md-0">
                                                            <img src="{{ Storage::url($item->user->photo) }}"
                                                                alt="" class="img-thumbnail rounded-circle">
                                                        </div>
                                                        <div class="col-md-8 col-12">
                                                            <h5 class="mb-0">{{ $item->user->name }}</h5>
                                                            <p class="small text-secondary mb-2">
                                                                {{ dateConversion($item->rating_date) }}</p>

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
                                @endif
                            </div>

                        </div>
                    </div>

                    <script>
                        // ambil elemen yang diperlukan
                        const dropdownToggles = document.querySelectorAll('[data-mdb-toggle="pill"]');

                        // tambahkan event listener untuk masing-masing elemen
                        dropdownToggles.forEach((toggle) => {
                            toggle.addEventListener('click', (event) => {
                                event.preventDefault();

                                // toggle kelas 'active' pada tombol dropdown yang diklik
                                toggle.classList.toggle('active');

                                // cari elemen tab content yang terkait
                                const target = document.querySelector(toggle.getAttribute('href'));

                                // toggle kelas 'show' pada tab content yang terkait
                                target.classList.toggle('show');
                            });
                        });
                    </script>

                </div>
                <div class="col-lg-4">
                    <div class="px-0 rounded-2 shadow-0">
                        <div class="card">
                            <div class="card-body">
                                <h6 class="card-title">Kategori Produk Serupa</h6>
                                <br>

                                @foreach ($latest_products as $item)
                                    <div class="d-flex mb-3">
                                        <a href="{{ route('customer.product.detail', $item->id) }}" class="me-3">
                                            <img src="{{ Storage::url($item->photo) }}"
                                                style="min-width: 96px; height: 96px;"
                                                class="img-md rounded border p-2" />
                                        </a>
                                        <div class="info">
                                            <a href="#" class="nav-link mb-1 fw-medium">
                                                {{ $item->name }}
                                            </a>
                                            <strong class="text-primary">Rp. {{ priceConversion($item->price) }}</strong>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
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
