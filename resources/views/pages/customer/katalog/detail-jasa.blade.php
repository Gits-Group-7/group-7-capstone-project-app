@extends('layouts.customer.template-customer')

@section('title')
    <title>Detail Jasa - {{ $service->name }} | Print-Shop</title>
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
                            src="{{ Storage::url($service->photo) }}" title="{{ $service->name }}" />
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="card rounded card-hover p-4">
                        <div class="ps-lg-3">
                            <h4 class="title text-dark">
                                {{ $service->name }}
                            </h4>
                            <div class="d-flex flex-row my-3 justify-content-start">
                                <div class="mb-1 me-2">
                                    @php
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

                                        <span class="ms-1 fs-20 fw-bold">( {{ $rating_service_count }} Reviews )</span>
                                    </div>

                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="d-flex justify-content-around">
                                    <h4 class="fw-bold fs-30">
                                        Rp. {{ priceConversion($service->price_per_pcs) }}
                                        <span class="text-muted pt-1 fs-20">/per Item</span>
                                    </h4>
                                    |
                                    <h4 class="fw-bold fs-30">
                                        Rp. {{ priceConversion($service->price_per_dozen) }}
                                        <span class="text-muted pt-1 fs-20">/per Lusin</span>
                                    </h4>
                                </div>
                            </div>

                            <p class="text-secondary text-justify">
                                {{ $service->description }}
                            </p>

                            @if (auth()->user())
                                <form
                                    action="{{ route('order.store.service.detail', ['user_id' => auth()->user()->id, 'service_id' => $service->id]) }}"
                                    method="POST">
                                    @csrf

                                    <div class="row mb-2">
                                        <div class="col-sm-6 col-md-6 col-6">
                                            <div class="form-group">
                                                <label class="mb-2 d-block fw-medium" for="material">Bahan</label>
                                                <select
                                                    class="form-select @error('material') is-invalid @enderror border border-secondary"
                                                    name="material" id="material" style="height: 35px;">
                                                    <option value="">Pilih Material</option>
                                                    <option value="Polo">Polo</option>
                                                    <option value="Katun">Katun</option>
                                                    <option value="Polyester">Polyester</option>
                                                    <option value="Rayon">Rayon</option>
                                                    <option value="Linen">Linen</option>
                                                    <option value="Wool">Wool</option>
                                                    <option value="Spandex">Spandex</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-6 mb-2 d-flex">
                                            <div class="form-group mx-auto my-auto">
                                                <label class="mb-2 d-block fw-medium" for="quantity">Jumlah</label>
                                                <div class="input-group mb-3" style="width: 170px;">
                                                    <button class="btn btn-white border border-secondary px-3"
                                                        type="button" id="btn-minus" data-mdb-ripple-color="dark">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>

                                                    <input type="text" name="quantity" id="quantity"
                                                        class="form-control @error('quantity') is-invalid @enderror text-center border border-secondary"
                                                        placeholder="1" min="1"
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1" value="1" />

                                                    <button class="btn btn-white border border-secondary px-3"
                                                        type="button" id="btn-plus" data-mdb-ripple-color="dark">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-6 d-flex">
                                            <div class="my-auto mx-start">
                                                @if (auth()->user() != null && auth()->user()->role == 'customer')
                                                    @if (DB::table('order_services')->where('service_id', $service->id)->where('user_id', auth()->user()->id)->exists())
                                                        <a href="{{ route('cart.index') }}" class="btn btn-theme shadow-0">
                                                            <i class="fa-solid fa-cart-shopping"></i> &ensp;
                                                            On My Order </a>
                                                    @elseif ($service->status == 'Habis' || $service->status == 'Pre Order')
                                                        <a href="#!" class="btn btn-block btn-theme shadow-0">
                                                            <i class="fa-solid fa-ban"></i> &ensp;
                                                            Service Unavailable
                                                        </a>
                                                    @else
                                                        {{-- action add to order --}}
                                                        <button type="submit" class="btn btn-theme shadow-0"> <i
                                                                class="fa-solid fa-cart-plus"></i>
                                                            &ensp;
                                                            Add to Order </button>
                                                    @endif
                                                @elseif (auth()->user() != null && auth()->user()->role == 'admin')
                                                    @if ($service->status == 'Habis' || $service->status == 'Pre Order')
                                                        <a href="#!" class="btn btn-block btn-theme shadow-0">
                                                            <i class="fa-solid fa-ban"></i> &ensp;
                                                            Service Unavailable
                                                        </a>
                                                    @else
                                                        <a href="#!" type="buttton" class="btn btn-theme shadow-0"> <i
                                                                class="fa-solid fa-cart-plus"></i>
                                                            &ensp;
                                                            Add to Order
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                </form>
                            @else
                                @guest
                                    <div class="row">
                                        <div class="col-sm-6 col-md-6 col-6">
                                            <div class="form-group">
                                                <label class="mb-2 d-block fw-medium" for="material">Bahan</label>
                                                <select
                                                    class="form-select @error('material') is-invalid @enderror border border-secondary"
                                                    name="material" id="material" style="height: 35px;">
                                                    <option value="">Pilih Material</option>
                                                    <option value="Polo">Polo</option>
                                                    <option value="Katun">Katun</option>
                                                    <option value="Polyester">Polyester</option>
                                                    <option value="Rayon">Rayon</option>
                                                    <option value="Linen">Linen</option>
                                                    <option value="Wool">Wool</option>
                                                    <option value="Spandex">Spandex</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-6 mb-2 d-flex">
                                            <div class="form-group mx-auto my-auto">
                                                <label class="mb-2 d-block fw-medium" for="quantity">Jumlah</label>
                                                <div class="input-group mb-3" style="width: 170px;">
                                                    <button class="btn btn-white border border-secondary px-3" type="button"
                                                        id="btn-minus" data-mdb-ripple-color="dark">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </button>

                                                    <input type="text" name="quantity" id="quantity"
                                                        class="form-control @error('quantity') is-invalid @enderror text-center border border-secondary"
                                                        placeholder="1" min="1"
                                                        aria-label="Example text with button addon"
                                                        aria-describedby="button-addon1" value="1" />

                                                    <button class="btn btn-white border border-secondary px-3" type="button"
                                                        id="btn-plus" data-mdb-ripple-color="dark">
                                                        <i class="fa-solid fa-plus"></i>
                                                    </button>

                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-6 col-6">
                                            <a href="{{ route('customer.login') }}" type="buttton"
                                                class="btn btn-theme shadow-0"> <i class="fa-solid fa-cart-plus"></i>
                                                &ensp;
                                                Add to Order
                                            </a>
                                        </div>
                                    </div>
                                @endguest
                            @endif
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                @if ($errors->has('material'))
                                    <div class="alert alert-danger">
                                        Bahan material order harus dipilih
                                    </div>
                                @endif
                            </div>

                            <div class="col-12">
                                @if ($errors->has('quantity'))
                                    <div class="alert alert-danger">
                                        Jumlah pesanan jasa harus di isi
                                    </div>
                                @endif
                            </div>
                        </div>

                        <hr />
                        <div class="row mt-3">
                            <dt class="col-5">Kategori:</dt>
                            <dd class="col-7 text-theme">Layanan {{ $service->category->name }}</dd>

                            <dt class="col-5">Nego : </dt>
                            <dd class="col-7 text-theme">Iya</dd>

                            <dt class="col-5">Estimasi Pengerjaan : </dt>
                            <dd class="col-7 text-theme">Minimal {{ $service->estimation }} Hari</dd>
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
                                Lihat Ulasan Layanan Jasa &ensp; <i class="fa-solid fa-caret-down"></i>
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
                                                Tulis Rating Jasa ({{ $service->name }})
                                            </button>

                                            {{-- Modal Rating --}}
                                            <div class="modal fade" tabindex="-1" id="kt_modal_stacked_1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Tambah Ulasan Jasa</h5>

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
                                                                action="{{ route('customer.rating.service', ['service_id' => $service->id, 'user_id' => Auth::user()->id]) }}"
                                                                method="POST">
                                                                @csrf

                                                                <div class="form-group mx-3 mb-4">
                                                                    <label for="rating" class="fw-medium mb-2">Berapa Rating
                                                                        Anda
                                                                        untuk
                                                                        Jasa Ini</label>

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
                                                                        placeholder="Berikan ulasan positif pada jasa kami"></textarea>
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
                                        <span class="text-secondary">*Ulasan layanan jasa ini belum ditambahkan</span>
                                    </div>
                                @else
                                    @foreach ($ratings as $item)
                                        <div class="col-10 mt-4">
                                            <div id="rating-user" class="card border">
                                                <div class="card-body m-3">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-4 col-12 mb-3 mb-md-0">
                                                            @if ($item->user->photo == 'empty')
                                                                <img src="{{ asset('customer/images/profile-customer.png') }}"
                                                                    alt="" class="img-thumbnail rounded-circle">
                                                            @else
                                                                <img src="{{ Storage::url($item->user->photo) }}"
                                                                    alt="" class="img-thumbnail rounded-circle">
                                                            @endif
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
                                <h6 class="card-title">Kategori Jasa Serupa</h6>
                                <br>

                                @foreach ($latest_services as $item)
                                    <div class="d-flex mb-3">
                                        <a href="{{ route('customer.service.detail', $item->id) }}" class="me-3">
                                            <img src="{{ Storage::url($item->photo) }}" class="border rounded me-3 p-2"
                                                style="width: 96px;" />
                                        </a>
                                        <div class="info">
                                            <a href="#" class="nav-link mb-1 fw-medium">
                                                {{ $item->name }}
                                            </a>
                                            <strong class="text-primary">Rp.
                                                {{ priceConversion($item->price_per_pcs) }}</strong>
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
