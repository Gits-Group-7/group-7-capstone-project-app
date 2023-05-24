@extends('layouts.customer.template-customer')

@section('title')
    <title>Daftar Transaksi Order | Print-Shop</title>
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
    
    function timestampConversion($timestamp)
    {
        // Format tanggal dan waktu asli
        $dateString = $timestamp;
    
        // Mengkonversi format menjadi waktu yang mudah dibaca
        $data = strtotime($dateString);
        $date = date('d-m-Y', $data);
        $time = date('H:i:s', $data);
    
        // konversi tanggal
        $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        $slug = explode('-', $date);
        $result_date = $slug[0] . ' ' . $month[(int) $slug[1]] . ' ' . $slug[2];
    
        $result = $result_date . ' ' . '(' . $time . ')';
        return $result;
    }
@endphp

@section('content')
    <!-- cart + summary -->
    <section class="my-5 transaksi-order-responsive">
        <div class="container">

            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div>
                        <h4 class="card-title mb-4 alert alert-primary mt-3 text-center">Manajemen Transaksi</h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 mb-4">
                    <div class="card border shadow-sm card-hover">
                        <div class="rounded-2 px-3 py-2 bg-white">
                            <!-- Pills navs -->
                            <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                                <li class="nav-item d-flex" role="presentation">
                                    <a class="nav-link d-flex align-items-center justify-content-center w-100 active nav-side-theme-product bg-secondary text-white"
                                        id="ex1-tab-1" data-mdb-toggle="pill" href="#transaction-product" role="tab"
                                        aria-controls="transaction-product" aria-selected="true">Daftar Transaksi Produk</a>
                                </li>
                                <li class="nav-item d-flex" role="presentation">
                                    <a class="nav-link d-flex align-items-center justify-content-center w-100 nav-side-theme-service bg-secondary text-white"
                                        id="ex1-tab-2" data-mdb-toggle="pill" href="#order-service" role="tab"
                                        aria-controls="order-service" aria-selected="false">Daftar Pesanan Jasa</a>
                                </li>
                            </ul>
                            <!-- Pills navs -->

                            <!-- Pills content -->
                            <div class="tab-content" id="ex1-content">
                                <div class="tab-pane fade show active" id="transaction-product" role="tabpanel"
                                    aria-labelledby="ex1-tab-1">

                                    {{-- Daftar Transaksi Produk --}}
                                    <div class="row">
                                        @if (!$transaction_product_customers->isEmpty())
                                            @foreach ($transaction_product_customers as $item)
                                                <div class="col-lg-12 mb-3">
                                                    <div class="card shadow-sm border card-hover">
                                                        <div class="card-body">
                                                            <div class="row mb-4">
                                                                <div class="col-lg-7 col-md-7 col-7">
                                                                    <span class="fw-bold">Kode Transaksi :
                                                                        {{ $item->id }}</span>
                                                                    <span class="text-success fw-medium">[
                                                                        {{ $item->status_delivery }}
                                                                        ]</span> <br>
                                                                    <span class="text-secondary">Tanggal Transaksi :
                                                                        {{ timestampConversion($item->order_date) }}
                                                                    </span>
                                                                </div>
                                                                <div
                                                                    class="col-lg-5 col-md-5 col-5 d-flex justify-content-end">
                                                                    <center class="pt-3 pb-2">

                                                                        <button type="button"
                                                                            class="btn btn-cancel-checkout mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal{{ $item->id }}">Batalkan
                                                                            Transaksi</button>

                                                                        <a href="#!" class="btn btn-checkout mb-2">
                                                                            Checkout Transaksi
                                                                        </a>
                                                                    </center>

                                                                    <!-- Modal Delete Transaksi -->
                                                                    <div class="modal fade"
                                                                        id="exampleModal{{ $item->id }}" tabindex="-1"
                                                                        aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        Hapus
                                                                                        transaksi produk?
                                                                                    </h5>
                                                                                    <button type="button" class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <i>*note : proses checkout akan
                                                                                        dibatalkan jika
                                                                                        anda
                                                                                        menghapus
                                                                                        transaksi produk.</i><br><br>
                                                                                    <span><b>Tanggal Order :</b>
                                                                                        {{ timestampConversion($item->order_date) }}</span><br>
                                                                                    <span><b>Status :</b>
                                                                                        {{ $item->status_delivery }}</span>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-checklist"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <a href="" type="button"
                                                                                        class="btn btn-hapus">Hapus</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row justify-content-around">
                                                                <div class="col-lg-4 col-md-4 mb-2 mt-2">
                                                                    <p>
                                                                        <span class="fw-medium">Kontak</span> <br>
                                                                        <span class="text-secondary">Nama Pelanggan :
                                                                            {{ auth()->user()->name }}</span> <br>
                                                                        <span class="text-secondary">Nomor HP :
                                                                            {{ auth()->user()->phone }}</span>
                                                                        <br>
                                                                        <span class="text-secondary">Email :
                                                                            {{ auth()->user()->email }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-5 col-md-6 mb-2 mt-2">
                                                                    <p class="text-justify">
                                                                        <span class="fw-medium">Informasi Pesanan</span>
                                                                        <br>
                                                                        <span class="text-secondary">
                                                                            @if ($item->order_address == '')
                                                                                Alamat : <i>Belum ditambahkan</i>.
                                                                            @else
                                                                                Alamat : {{ $item->order_address }}.
                                                                            @endif
                                                                        </span> <br>
                                                                        <span class="text-secondary">
                                                                            @if ($item->order_note == '')
                                                                                Catatan : <i>Tidak ditambahkan</i>.
                                                                            @else
                                                                                Catatan : {{ $item->order_note }}.
                                                                            @endif
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-3 col-md-12 mb-2 mt-2">
                                                                    <span class="fw-medium">Pembayaran</span> <br>
                                                                    <span class="text-secondary">Ongkos Pengiriman : Rp.
                                                                        {{ priceConversion($item->delivery_price) }}</span>
                                                                    <br>
                                                                    <span class="text-secondary">
                                                                        @if ($item->prof_order_payment == 'empty')
                                                                            Sudah Dibayar :
                                                                            <span
                                                                                class="span text-white bg-red-theme px-3 rounded">
                                                                                Belum Dibayar
                                                                            </span>
                                                                        @elseif(!$item->prof_order_payment == 'empty')
                                                                            Sudah Dibayar :
                                                                            <span
                                                                                class="span text-white bg-green-theme px-3 rounded">
                                                                                Lunas
                                                                            </span>
                                                                        @endif
                                                                    </span> <br>
                                                                    <span class="text-secondary">
                                                                        @if ($item->order_confirmed == 'No')
                                                                            Status Pesanan :
                                                                            <span
                                                                                class="span text-white bg-red-theme px-3 rounded">
                                                                                Pending
                                                                            </span>
                                                                        @elseif($item->order_confirmed == 'Yes')
                                                                            Status Pesanan :
                                                                            <span
                                                                                class="span text-white bg-green-theme px-3 rounded">
                                                                                Diproses
                                                                            </span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($transaction_product_customers->isEmpty())
                                            <p>*Tidak ada riwayat transaksi produk aktif milik pelanggan</p>
                                        @endif
                                    </div>
                                </div>
                                <div class="tab-pane fade mb-2" id="order-service" role="tabpanel">

                                    {{-- Daftar Order Service --}}
                                    <div class="row">
                                        @if (!$order_service_customers->isEmpty())
                                            @foreach ($order_service_customers as $item)
                                                <div class="col-lg-12 mb-3">
                                                    <div class="card shadow-sm border card-hover">
                                                        <div class="card-body">
                                                            <div class="row mb-4">
                                                                <div class="col-lg-7 col-md-7 col-7">
                                                                    <span class="fw-bold">Kode Pesanan :
                                                                        {{ $item->id }}</span>
                                                                    <span class="text-success fw-medium">[
                                                                        {{ $item->status_delivery }}
                                                                        ]</span> <br>
                                                                    <span class="text-secondary">Tanggal Pesanan :
                                                                        {{ timestampConversion($item->order_date) }}
                                                                    </span>
                                                                </div>
                                                                <div
                                                                    class="col-lg-5 col-md-5 col-5 d-flex justify-content-end">
                                                                    <center class="pt-3 pb-2">

                                                                        <button type="button"
                                                                            class="btn btn-cancel-checkout mb-2"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#exampleModal{{ $item->id }}">Batalkan
                                                                            Pesanan</button>

                                                                        <a href="#!" class="btn btn-checkout mb-2">
                                                                            Checkout Pesanan
                                                                        </a>
                                                                    </center>

                                                                    <!-- Modal Delete Transaksi -->
                                                                    <div class="modal fade"
                                                                        id="exampleModal{{ $item->id }}"
                                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="exampleModalLabel">
                                                                                        Hapus
                                                                                        pesanan jasa?
                                                                                    </h5>
                                                                                    <button type="button"
                                                                                        class="btn-close"
                                                                                        data-bs-dismiss="modal"
                                                                                        aria-label="Close"></button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <i>*note : proses checkout akan
                                                                                        dibatalkan jika
                                                                                        anda
                                                                                        menghapus
                                                                                        pesanan jasa.</i><br><br>
                                                                                    <span><b>Tanggal Order :</b>
                                                                                        {{ timestampConversion($item->order_date) }}</span><br>
                                                                                    <span><b>Status :</b>
                                                                                        {{ $item->status_delivery }}</span>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="button"
                                                                                        class="btn btn-checklist"
                                                                                        data-bs-dismiss="modal">Batal</button>
                                                                                    <a href="" type="button"
                                                                                        class="btn btn-hapus">Hapus</a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row justify-content-around">
                                                                <div class="col-lg-4 col-md-4 mb-2 mt-2">
                                                                    <p>
                                                                        <span class="fw-medium">Kontak</span> <br>
                                                                        <span class="text-secondary">Nama Pelanggan :
                                                                            {{ auth()->user()->name }}</span> <br>
                                                                        <span class="text-secondary">Nomor HP :
                                                                            {{ auth()->user()->phone }}</span>
                                                                        <br>
                                                                        <span class="text-secondary">Email :
                                                                            {{ auth()->user()->email }}</span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-5 col-md-6 mb-2 mt-2">
                                                                    <p class="text-justify">
                                                                        <span class="fw-medium">Informasi Pesanan</span>
                                                                        <br>
                                                                        <span class="text-secondary">
                                                                            @if ($item->order_address == '')
                                                                                Alamat : <i>Belum ditambahkan</i>.
                                                                            @else
                                                                                Alamat : {{ $item->order_address }}.
                                                                            @endif
                                                                        </span> <br>
                                                                        <span class="text-secondary">
                                                                            @if ($item->order_note == '')
                                                                                Catatan : <i>Tidak ditambahkan</i>.
                                                                            @else
                                                                                Catatan : {{ $item->order_note }}.
                                                                            @endif
                                                                        </span>
                                                                    </p>
                                                                </div>
                                                                <div class="col-lg-3 col-md-12 mb-2 mt-2">
                                                                    <span class="fw-medium">Pembayaran</span> <br>
                                                                    <span class="text-secondary">Ongkos Pengiriman : Rp.
                                                                        {{ priceConversion($item->delivery_price) }}</span>
                                                                    <br>
                                                                    <span class="text-secondary">
                                                                        @if ($item->prof_order_payment == 'empty')
                                                                            Sudah Dibayar :
                                                                            <span
                                                                                class="span text-white bg-red-theme px-3 rounded">
                                                                                Belum Dibayar
                                                                            </span>
                                                                        @elseif(!$item->prof_order_payment == 'empty')
                                                                            Sudah Dibayar :
                                                                            <span
                                                                                class="span text-white bg-green-theme px-3 rounded">
                                                                                Lunas
                                                                            </span>
                                                                        @endif
                                                                    </span> <br>
                                                                    <span class="text-secondary">
                                                                        @if ($item->order_confirmed == 'No')
                                                                            Status Pesanan :
                                                                            <span
                                                                                class="span text-white bg-red-theme px-3 rounded">
                                                                                Pending
                                                                            </span>
                                                                        @elseif($item->order_confirmed == 'Yes')
                                                                            Status Pesanan :
                                                                            <span
                                                                                class="span text-white bg-green-theme px-3 rounded">
                                                                                Diproses
                                                                            </span>
                                                                        @endif
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif($order_service_customers->isEmpty())
                                            <p>*Tidak ada riwayat pesanan jasa aktif milik pelanggan</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Pills content -->
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection
