@extends('layouts.admin.template-admin')

@section('title')
    <title>
        Manajemen Order Jasa Pelanggan | Print-Shop</title>
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
                        di Manajemen data Order Jasa
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Data Order Jasa</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Admin dapat mengkonfirmasi Pesanan Order Jasa
                                milik Customer, dan Update Progress Pesanan (Tracking).
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="display expandable-table" style="width:100%">
                                    <thead>
                                        <tr class="mx-auto">
                                            <th class="text-center">No</th>
                                            <th class="text-center">Nama Customer</th>
                                            <th class="text-center">Kode Pesanan</th>
                                            <th class="text-center">Tanggal Pemesanan</th>
                                            <th class="text-center">Biaya Pesanan</th>
                                            <th class="text-center">Status Pesanan</th>
                                            <th class="text-center">Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($list_orders as $item)
                                            <tr class="shadow-sm">
                                                <td class="text-center">{{ $no }}</td>
                                                <td class="text-center">{{ $item->user->name }}</td>
                                                <td class="text-center">{{ $item->id }}</td>
                                                <td class="text-center">{{ timestampConversion($item->order_date) }}</td>
                                                <td class="text-center">Rp.
                                                    {{ priceConversion($item->total_price_transaction_order) }}</td>
                                                <td class="text-center">{{ $item->status_delivery }}</td>

                                                <td class="text-center">
                                                    @if ($item->order_confirmed == 'No')
                                                        {{-- Konfirmasi Pesanan --}}
                                                        <div class="btn-group-vertical" role="group"
                                                            aria-label="Basic example">
                                                            <button type="button" class="btn btn-inverse-success py-3 px-3"
                                                                data-toggle="modal"
                                                                data-target="#prof-order-payment-{{ $item->id }}">
                                                                Konfirmasi</button>
                                                        </div>
                                                    @elseif($item->order_confirmed == 'Yes')
                                                        {{-- Update Tracking --}}
                                                        <div class="btn-group-vertical" role="group"
                                                            aria-label="Basic example">
                                                            <button type="button" class="btn btn-inverse-success py-3 px-3"
                                                                data-toggle="modal"
                                                                data-target="#prof-order-payment-{{ $item->id }}">Ubah
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="prof-order-payment-{{ $item->id }}"
                                                tabindex="-1" role="dialog" aria-labelledby="prof-order-paymentLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="prof-order-paymentLabel">Konfirmasi
                                                                Pesanan
                                                                <b>"{{ $item->user->name }}"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                <img src="{{ Storage::url($item->prof_order_payment) }}"
                                                                    class="img-fluid rounded mb-3">
                                                                Jenis Pesanan :
                                                                @if ($item->type_transaction_order == 'product')
                                                                    Order Jasa
                                                                @elseif($item->type_transaction_order == 'service')
                                                                    Order Jasa
                                                                @endif
                                                                <br>
                                                                Harga Pesanan : Rp.
                                                                {{ priceConversion($item->total_price_transaction_order) }}<br>
                                                                Status Pesanan : {{ $item->status_delivery }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Tutup</button>
                                                            <form
                                                                action="{{ route('admin.manage.order.confirm', $item->id) }}"
                                                                method="POST">
                                                                @method('put')
                                                                @csrf

                                                                <button type="submit" class="btn btn-success">Proses
                                                                    Pesanan</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
