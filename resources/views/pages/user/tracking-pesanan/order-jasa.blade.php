@extends('layouts.user.template-user')

@section('title')
    <title>Tracking Order Jasa | Print-Shop</title>
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
                        di Menu Tracking Pesanan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Halaman Tracking Pesanan Jasa</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat mencari dan melihat Riwayat Order
                                Jasa dan Status Tracking Jasa Pesanan Anda.
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
                        <p class="card-title">Tabel Daftar Order Jasa</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr class="mx-auto">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kode Pesanan</th>
                                                <th class="text-center">Tanggal Pesanan</th>
                                                <th class="text-center">Catatan Pesanan</th>
                                                <th class="text-center">Detail Pesanan</th>
                                                <th class="text-center">Tracking Pesanan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp

                                            @foreach ($customer_orders as $items)
                                                <tr>
                                                    <td class="text-center">{{ $no }}</td>
                                                    <td class="text-center">{{ $items->id }}</td>
                                                    <td class="text-center">
                                                        {{ timestampConversion($items->order_date) }}
                                                    </td>
                                                    <td class="text-center">
                                                        @if ($items->order_note == null)
                                                            Tidak Ada Catatan
                                                        @else
                                                            {{ $items->order_note }}
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-inverse-primary py-3 px-3"
                                                            data-toggle="modal"
                                                            data-target="#modalDetail{{ $items->id }}">Detail
                                                            Info Lain</button>
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" class="btn btn-inverse-success py-3 px-3"
                                                            data-toggle="modal"
                                                            data-target="#modalTracking{{ $items->id }}">Lacak
                                                            Pelayanan</button>
                                                    </td>
                                                </tr>

                                                <!-- Modal Detail -->
                                                <div class="modal fade" id="modalDetail{{ $items->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Detail
                                                                    Pesanan
                                                                    Jasa
                                                                    <b>"{{ $items->id }}"</b>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>
                                                                    Nama Pemesan : {{ $items->user->name }}<br>
                                                                    Harga Pengiriman : Rp.
                                                                    {{ priceConversion($items->delivery_price) }}<br>
                                                                    Total Harga Pesanan : Rp.
                                                                    {{ priceConversion($items->total_price_transaction_order) }}<br>
                                                                    Status Pesanan : {{ $items->status_delivery }}<br>
                                                                </p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal Tracking -->
                                                <div class="modal fade" id="modalTracking{{ $items->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Tracking
                                                                    Layanan
                                                                    Jasa
                                                                    <b>"{{ $items->id }}"</b>
                                                                </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                    aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row mb-3">
                                                                    <div class="col font-weight-bold text-center">Tanggal
                                                                    </div>
                                                                    <div class="col font-weight-bold text-center">Lokasi
                                                                    </div>
                                                                    <div class="col font-weight-bold">Status</div>
                                                                </div>
                                                                <hr>
                                                                @foreach ($tracking_order_log as $logs)
                                                                    @if ($logs->transaction_order_id == $items->id)
                                                                        <div class="row">
                                                                            <div class="col text-center">
                                                                                {{ timestampConversion($logs->created_at) }}
                                                                            </div>
                                                                            <div class="col text-center">
                                                                                @if ($logs->location == null)
                                                                                    -
                                                                                @else
                                                                                    {{ $logs->location }}
                                                                                @endif
                                                                            </div>
                                                                            <div class="col">
                                                                                {{ $logs->status }}</div>
                                                                        </div>
                                                                        <hr>
                                                                    @endif
                                                                @endforeach
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
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
