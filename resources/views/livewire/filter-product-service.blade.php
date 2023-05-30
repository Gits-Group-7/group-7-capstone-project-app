<div>
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

        function convertToTitleCase($string)
        {
            return ucfirst($string);
        }

        function roundToOneDecimal($number)
        {
            $rounded = round($number, 1); // Bulatkan angka dengan satu angka di belakang koma
            return number_format($rounded, 1); // Format angka dengan satu angka di belakang koma
        }
    @endphp

    <div class="container">
        <div class="row justify-content-around">

            {{-- konten navigasi katalog dan rating --}}
            <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 mb-3">
                <div class="card border shadow-sm card-hover">
                    <div class="m-4">

                        <div class="form-group">
                            <label class="mb-2 fw-medium" for="filter">Filter Produk & Jasa</label>
                            <select class="form-control" id="filter" name="filter" wire:model="byCategories"
                                onchange="filterByCategories(this.value)">
                                <option value="">Pilih Kategori Produk atau Jasa</option>
                                @foreach ($categories as $item)
                                    <option value="{{ $item->id }}"> [{{ convertToTitleCase($item->type) }}]
                                        {{ $item->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- livewire script --}}
                        @push('scripts')
                            <script>
                                function filterByCategories(categoryId) {
                                    Livewire.emit('filterByCategories', categoryId);
                                }
                            </script>
                        @endpush

                        @livewireScripts
                        <script>
                            Livewire.on('filterByCategories', categoryId => {
                                window.livewire.emit('filterByCategories', categoryId);
                            });
                        </script>

                        {{-- recent rating --}}
                        <label class="mt-4 fw-medium" for="filter">Latest Customer Rating</label>

                        @if (!$latest_rating->isEmpty())
                            @foreach ($latest_rating as $item)
                                <div id="rating-user" class="card border card-hover my-3">
                                    <div class="card-body m-3">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{ Storage::url($item->user->photo) }}" alt=""
                                                    class="img-thumbnail rounded-circle">
                                            </div>
                                            <div class="col-8">
                                                <span class="fw-medium">{{ $item->user->name }}</span><br>
                                                {{ dateConversion($item->rating_date) }}<br>

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

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <p id="comment-rating" class="text-justify mt-3">
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
                            @endforeach
                        @else
                            <br>
                            <div class="mt-2">
                                <span><i>Rating Belum Ditambahkan</i></span>

                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-12 mb-3">
                                @auth
                                    @if (Auth::user()->role == 'customer')
                                        <button type="button" class="btn btn-block btn-rating" data-bs-toggle="modal"
                                            data-bs-target="#kt_modal_stacked_1">
                                            Tulis Rating Toko
                                        </button>

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
                                                            <i class="ki-duotone ki-cross fs-1"><span
                                                                    class="path1"></span><span class="path2"></span></i>
                                                        </div>
                                                        <!--end::Close-->
                                                    </div>

                                                    <div class="modal-body">
                                                        <form
                                                            action="{{ route('customer.rating.store', Auth::user()->id) }}"
                                                            method="POST">
                                                            @csrf

                                                            <div class="form-group mx-3 mb-4">
                                                                <label for="rating" class="fw-medium mb-2">Berapa Rating
                                                                    Anda
                                                                    untuk
                                                                    Toko Ini</label>

                                                                <div class="rating d-flex justify-content-around my-2">
                                                                    <div class="">
                                                                        <!--begin::Star 1-->
                                                                        <label class="rating-label" for="kt_rating_input_1">
                                                                            <i class="fa-solid fa-star star-rating"></i>
                                                                        </label>
                                                                        <input class="rating-input" name="rating"
                                                                            value="1" type="radio"
                                                                            id="kt_rating_input_1" />
                                                                        <!--end::Star 1-->
                                                                    </div>

                                                                    <div class="">
                                                                        <!--begin::Star 2-->
                                                                        <label class="rating-label" for="kt_rating_input_2">
                                                                            <i class="fa-solid fa-star star-rating"></i>
                                                                        </label>
                                                                        <input class="rating-input" name="rating"
                                                                            value="2" type="radio"
                                                                            id="kt_rating_input_2" name="rating" />
                                                                        <!--end::Star 2-->
                                                                    </div>

                                                                    <div class="">
                                                                        <!--begin::Star 3-->
                                                                        <label class="rating-label" for="kt_rating_input_3">
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
                                                                    Rating</label>
                                                                <textarea class="form-control" id="comment" rows="4" name="comment"
                                                                    placeholder="Berikan Komentar Positif pada Toko kami"></textarea>
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
                                    @endif
                                @endauth

                                @guest
                                    <a href="{{ route('customer.login') }}" class="btn btn-block btn-rating">Login untuk
                                        memberikan
                                        rating</a>
                                @endguest
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

                    @if ($byCategories)
                        @if ($products->count())
                            {{-- katalog produk --}}
                            @foreach ($products as $product)
                                @if ($product->category_id == $byCategories)
                                    <div class="item col-6 d-flex justify-content-center p-1">
                                        <div class="card my-2 shadow-sm p-4 card-hover">
                                            <a href="{{ route('customer.product.detail', $product->id) }}"
                                                class="img-wrap">
                                                <img src="{{ Storage::url($product->photo) }}"
                                                    class="card-img-top rounded" title="{{ $product->name }}"
                                                    style="aspect-ratio: 1 / 1">
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
                                                                <span class="text-theme-two fw-bold">Rp.
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
                                @endif
                            @endforeach
                        @endif

                        @if ($services->count())
                            {{-- katalog jasa --}}
                            @foreach ($services as $service)
                                @if ($service->category_id == $byCategories)
                                    <div class="item col-6 d-flex justify-content-center p-1">
                                        <div class="card my-2 shadow-sm p-4 card-hover">
                                            <a href="{{ route('customer.service.detail', $service->id) }}"
                                                class="img-wrap">
                                                <img src="{{ Storage::url($service->photo) }}"
                                                    class="card-img-top rounded" title="{{ $service->name }}"
                                                    style="aspect-ratio: 1 / 1">
                                            </a>
                                            <div class="card-body p-0 pt-2">
                                                <h6 class="card-title mt-2 pt-2 limit-text"
                                                    title="{{ $service->name }}">
                                                    <span class="text-black fw-bold">{{ $service->name }}</span>
                                                </h6>

                                                <div class="row">
                                                    <div class="col d-flex">
                                                        <span class="card-text mx-auto my-auto">
                                                            <span class="text-theme-two fw-bold">Rp.
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
                                @endif
                            @endforeach
                        @endif
                    @else
                        {{-- katalog produk --}}
                        @foreach ($products as $value)
                            <div class="item col-6 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="{{ route('customer.product.detail', $value->id) }}" class="img-wrap">
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
                        @endforeach

                        {{-- katalog jasa --}}
                        @foreach ($services as $value)
                            <div class="item col-6 d-flex justify-content-center p-1">
                                <div class="card my-2 shadow-sm p-4 card-hover">
                                    <a href="{{ route('customer.service.detail', $value->id) }}" class="img-wrap">
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
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
