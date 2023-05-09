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

    <section>
        <div class="container">
            <div class="row">
                {{-- konten navigasi katalog dan rating --}}
                <div class="col-4 mb-3">
                    <div class="card border shadow-sm card-hover">
                        <div class="m-4">
                            <div class="form-group">
                                <label class="mb-2 fw-medium" for="filter">Filter Produk & Jasa</label>
                                <select class="form-control" id="filter" name="filter">
                                    <option value="">Katalog Produk & Jasa</option>
                                    <option value="Katalog Produk">Katalog Produk</option>
                                    <option value="Katalog Jasa">Katalog Jasa</option>
                                </select>
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
                                                <span class="rating-number fw-medium text-theme">(5)</span>
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
                                                <span class="rating-number fw-medium text-theme">(5)</span>
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
                                <div class="col-12">
                                    <a href="#!" class="btn btn-block btn-rating">Tulis Rating Toko</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-8 mb-3" id="product-service">
                    <div class="card border shadow-sm card-hover">
                        <div class="m-4">
                            <p>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis doloribus harum optio qui
                                eos autem facilis commodi atque velit. Saepe cumque nulla nostrum sed perspiciatis ducimus
                                et autem voluptates minus! Perspiciatis autem necessitatibus saepe ipsam minima? Officiis
                                perspiciatis fugit nam reprehenderit veritatis quidem. Molestiae ut, ipsam quasi modi hic
                                doloremque corporis est delectus neque quo nemo non, velit dolorum beatae, voluptatibus
                                nesciunt saepe eligendi rem earum error dicta? Delectus debitis perspiciatis cum veniam
                                exercitationem natus sunt aspernatur eius facere quod praesentium blanditiis nisi
                                repudiandae ullam voluptate atque, quos iusto fuga provident distinctio sequi deserunt quam,
                                ducimus ipsa! Voluptatem necessitatibus sint, perferendis, reprehenderit excepturi pariatur
                                nulla illum rem ipsa unde praesentium, est velit! Quis quibusdam illo rem esse aperiam quos,
                                labore molestiae, qui ab similique incidunt! Animi mollitia architecto laborum unde nihil
                                tempora impedit et, fuga quo minus perspiciatis amet, nulla cum quam ipsa illum facilis
                                corporis! Quia, repellat rerum eius magni ullam libero, animi quibusdam aliquid iusto, illum
                                laudantium dignissimos quo. Error animi, eaque maxime unde facilis sint fugit quas
                                praesentium dolor impedit odio sapiente nesciunt temporibus recusandae id minima! Ad enim,
                                ut quam sit placeat nesciunt illo sapiente impedit quidem dignissimos cupiditate deserunt
                                tempore? Facilis accusamus est eligendi vel amet, beatae tempore. Velit asperiores eveniet
                                temporibus ipsa autem saepe fugiat numquam laudantium quis fuga nisi quia ea vitae
                                consequuntur ut perferendis sint voluptates incidunt ex tenetur at, itaque quam suscipit. Ex
                                enim ut similique ipsum a vitae impedit. Ut repudiandae perferendis sit, animi, ad a dolores
                                eligendi voluptas ipsam laborum ipsa error autem aut quo iste, corporis atque rerum vel
                                fugiat dolorum ab! Quia repudiandae ullam dignissimos eligendi veniam maiores doloribus
                                deleniti impedit corporis sequi ducimus sapiente officia eaque cupiditate cum quasi soluta
                                illo perspiciatis necessitatibus, temporibus inventore. Harum dicta illo corrupti dolorum
                                illum voluptatem dolore et non excepturi atque ex, praesentium facilis? Reiciendis labore
                                praesentium optio odio explicabo sequi aspernatur, impedit nam inventore placeat pariatur
                                dolor repellendus accusantium, facilis ea quis iusto, aperiam delectus autem! Voluptas nam
                                dignissimos, commodi quia sed, animi, fugiat soluta mollitia aliquam rerum ab ipsa velit vel
                                earum sapiente accusamus dolor minus dolores culpa. Totam suscipit fugiat non, corporis
                                neque molestiae in natus nulla ipsa libero labore, quae expedita soluta molestias fugit
                                vitae placeat corrupti architecto quaerat! Voluptatem reprehenderit, soluta saepe officia
                                explicabo laborum minima placeat, rerum numquam deserunt fugit vero in, eos nisi at
                                sapiente. Nihil ratione nisi, nesciunt quo exercitationem quod culpa sint enim consequatur
                                itaque beatae sunt ea accusantium, explicabo voluptates ducimus deserunt possimus
                                perferendis magni assumenda illum ab quidem placeat. Ex, error saepe! Ad suscipit beatae
                                necessitatibus itaque. Sint sit optio, eaque excepturi unde laboriosam accusamus laborum
                                exercitationem perferendis autem, ipsam adipisci necessitatibus alias fugit delectus
                                accusantium architecto. Totam velit neque voluptatum illo nostrum fugiat laboriosam impedit
                                corporis voluptas non modi blanditiis, obcaecati esse rerum. Laborum doloribus odit rem, ex
                                repellendus nemo dolor quisquam eum autem doloremque libero, quae fuga illum consequuntur
                                quod! Ipsam sunt nulla a, inventore, amet aperiam voluptatem dicta laboriosam, officia vitae
                                debitis odit architecto ad optio!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
