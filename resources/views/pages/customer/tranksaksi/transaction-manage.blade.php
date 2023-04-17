@extends('layouts.customer.template-customer')

@section('title')
    <title>Manajemen Transaksi | Gadget Web Store</title>
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
    <section class="my-5">
        <div class="container">
            <h4 class="card-title mb-4 alert alert-primary mt-3">Manajemen Transaksi</h4>

            <div class="row">
                @foreach ($transactions as $item)
                    <div class="col-lg-3 mb-3">
                        <div class="card shadow-sm border card-hover">
                            <div class="card-body">
                                <div class="card-title">
                                    <span class="fw-bold">Detail Transaksi :</span>
                                </div>

                                <span class="">
                                    <b>Tanggal Order :</b><br>
                                    <i>{{ timestampConversion($item->order_date) }}</i>
                                </span>
                                <br>
                                <span class="">
                                    <b>Status :</b>
                                    <i>{{ $item->status }}</i>
                                </span>

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Hapus transaksi?
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <i>*note : proses checkout akan dibatalkan jika anda menghapus data
                                                    transaksi.</i><br><br>
                                                <span><b>Tanggal Order :</b>
                                                    {{ timestampConversion($item->order_date) }}</span><br>
                                                <span><b>Status :</b> {{ $item->status }}</span>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-checklist"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <a href="{{ route('transaction.destroy', $item->id) }}" type="button"
                                                    class="btn btn-hapus">Hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                @if ($item->status == 'Success Order')
                                    <div class="mt-3">
                                        <button type="submit" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $item->id }}"
                                            class="btn btn-cancel w-100 shadow-0 mb-2">Delete
                                            Log Transaksi</button>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('customer.transaction.detail', $item->id) }}"
                                            class="btn btn-checklist w-100 shadow-0 mb-2">Lihat
                                            Transaksi</a>
                                    </div>
                                @else
                                    <div class="mt-3">
                                        <button type="submit" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal{{ $item->id }}"
                                            class="btn btn-cancel w-100 shadow-0 mb-2">Batalkan / Delete
                                            Transaksi</button>
                                    </div>
                                    <div class="mt-2">
                                        <a href="{{ route('customer.transaction.proccess', $item->id) }}"
                                            class="btn btn-checklist w-100 shadow-0 mb-2">Checkout Sekarang</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>
@endsection
