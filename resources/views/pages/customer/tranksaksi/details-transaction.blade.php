@extends('layouts.customer.template-customer')

@section('title')
    <title>Detail Tranksaksi | Gadget Web Store</title>
@endsection

@php
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
    <!-- cart + summary -->
    <section class="my-5">
        <div class="container">
            <h4 class="card-title mb-4 alert alert-primary mt-3">Detail Tranksaksi</h4>

            <div class="row justify-content-center">
                <div class="col-lg-5 mb-3">
                    <div class="card shadow-sm border card-hover">
                        <div class="card-body">
                            <div class="card-title">
                                <span class="fw-bold">Detail Transaksi :</span>
                            </div>

                            <span>
                                Tanggal Order :
                                <i>{{ timestampConversion($transaction->order_date) }}</i>
                            </span>
                            <br>
                            <span>
                                Status :
                                <i>{{ $transaction->status }}</i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="col-lg-5 mb-3">
                    <div class="card shadow-sm border card-hover">
                        <div class="card-body">
                            <div class="card-title">
                                <span class="fw-bold">Detail Transaksi Produk :</span>
                            </div>

                            @if ($transaction->status == 'Success Order')
                                {{-- jika status sudah succes order --}}
                                <ul>
                                    @foreach ($transaction_list as $item)
                                        <li>
                                            <span>
                                                {{ $item->name }} ({{ $item->quantity }}) :
                                                <i>Rp. {{ priceConversion($item->total_price) }}</i>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>

                                <span class="fw-bold">Total : Rp. {{ priceConversion($total_price_transaction) }}</span>
                            @elseif ($transaction->status == 'Transaction Proccess')
                                {{-- jika status masih process transaction --}}
                                @if (DB::table('carts')->count())
                                    <ul>
                                        @foreach ($cart_products as $item)
                                            <li>
                                                <span>
                                                    {{ $item->name }} ({{ $item->quantity }}) :
                                                    <i>Rp. {{ priceConversion($item->total_price) }}</i>
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>

                                    <span class="fw-bold">Total : Rp. {{ priceConversion($total_price_cart) }}</span>
                                @else
                                    <div class="pb-3 text-secondary">
                                        <i><u>*Mohon Tambahkan Produk Sebelum
                                                Melakukan Checkout</u></i>
                                    </div>

                                    <span class="fw-bold">Total : Rp. {{ priceConversion($total_price_cart) }}</span>
                                @endif
                            @endif

                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <div class="mt-2">
                            @if ($transaction->status == 'Transaction Proccess')
                                {{-- jika status masih process transaction --}}
                                <a href="{{ route('customer.transaction.proccess', $transaction->id) }}" type="button"
                                    class="btn btn-checklist w-100 shadow-0 mb-2">Anda Belum Checkout
                                </a>
                            @elseif($transaction->status == 'Success Order')
                                {{-- jika status sudah succes order --}}
                                <a href="{{ route('transaction.index') }}" type="button"
                                    class="btn btn-checklist w-100 shadow-0 mb-2">Anda Sudah
                                    Checkout</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
