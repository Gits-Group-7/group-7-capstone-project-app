@extends('layouts.admin.template-admin')

@section('title')
    <title>Daftar Transaksi Order | Print-Shop</title>
@endsection

@php
    function priceConversion($price)
    {
        $formattedPrice = number_format($price, 0, ',', '.');
        return $formattedPrice;
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
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Menu Layanan Customer
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Transaction Order Customer</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat mencari dan mencocokkan data
                                transaksi dan order milik customer.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body card-hover rounded">
                        <p class="card-title">Tabel Data Transaksi dan Order</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No</th>
                                                <th class="text-center">Nama Pelanggan</th>
                                                <th class="text-center">Kode Pesanan</th>
                                                <th class="text-center">Jenis Pesanan</th>
                                                <th class="text-center">Tanggal Pesanan</th>
                                                <th class="text-center">Detail Pesanan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp

                                            @foreach ($transaction_orders as $items)
                                                <tr>
                                                    <td class="text-center">{{ $no }}</td>
                                                    <td class="text-center">{{ $items->user->name }}</td>
                                                    <td class="text-center">{{ $items->id }}</td>
                                                    <td class="text-center">
                                                        @if ($items->type_transaction_order == 'product')
                                                            Pesanan Produk
                                                        @elseif($items->type_transaction_order = 'service')
                                                            Pesanan Jasa
                                                        @endif
                                                    </td>
                                                    <td class="text-center">{{ timestampConversion($items->order_date) }}
                                                    </td>
                                                    <td class="text-center">
                                                        {{-- Modal Button Detail Info Pesanan --}}
                                                        <button type="button" class="btn btn-inverse-success py-3 px-3"
                                                            data-toggle="modal"
                                                            data-target="#prof-order-payment-{{ $items->id }}">Detail
                                                            Info
                                                        </button>
                                                    </td>

                                                    <!-- Modal Detail Info Pesanan -->
                                                    <div class="modal fade" id="prof-order-payment-{{ $items->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="prof-order-paymentLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="prof-order-paymentLabel">
                                                                        Detail Informasi Pesanan
                                                                        <b>"{{ $items->id }}"</b>
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>
                                                                        <img src="{{ Storage::url($items->prof_order_payment) }}"
                                                                            class="img-fluid rounded mb-3">
                                                                        <br>
                                                                        <span class="fw-medium"> Harga Pesanan :</span> Rp.
                                                                        {{ priceConversion($items->total_price_transaction_order) }}<br>
                                                                        <span class="fw-medium">
                                                                            Status Pesanan :</span>
                                                                        {{ $items->status_delivery }}
                                                                        <br>
                                                                        <span class="fw-medium">
                                                                            Alamat Pesanan :</span>
                                                                        {{ $items->order_address }}
                                                                    </p>
                                                                    <hr>

                                                                    @if ($items->type_transaction_order == 'product')
                                                                        <p class="fw-medium">Daftar Produk yang dipesan:</p>
                                                                        @foreach ($transaction_products as $product)
                                                                            @if ($product->transaction_order_id == $items->id)
                                                                                <div class="row justify-content-around">
                                                                                    <div class="col-2">
                                                                                        <img src="{{ Storage::url($product->product->photo) }}"
                                                                                            class="img-fluid rounded"
                                                                                            alt="">
                                                                                    </div>
                                                                                    <div class="col-10 d-flex">
                                                                                        <span class="my-auto">
                                                                                            {{ $product->product->name }}
                                                                                            <span
                                                                                                class="fw-medium">({{ $product->quantity }}x)
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                            @endif
                                                                        @endforeach
                                                                    @elseif($items->type_transaction_order == 'service')
                                                                        <p class="fw-medium">Daftar Jasa yang dipesan:</p>
                                                                        @foreach ($order_services as $service)
                                                                            @if ($service->transaction_order_id == $items->id)
                                                                                <div class="row justify-content-around">
                                                                                    <div class="col-2">
                                                                                        <img src="{{ Storage::url($service->service->photo) }}"
                                                                                            class="img-fluid rounded"
                                                                                            alt="">
                                                                                    </div>
                                                                                    <div class="col-10 d-flex">
                                                                                        <span class="my-auto">
                                                                                            {{ $service->service->name }}
                                                                                            <span
                                                                                                class="fw-medium">({{ $service->quantity }}x)
                                                                                            </span>
                                                                                        </span>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button"
                                                                        class="btn btn-primary w-100 py-3"
                                                                        data-dismiss="modal">Tutup</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </tr>
                                                @php
                                                    $no++;
                                                @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    {{-- Datatable init --}}
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
    <script src="{{ asset('admin/js/template.js') }}"></script>
@endsection
