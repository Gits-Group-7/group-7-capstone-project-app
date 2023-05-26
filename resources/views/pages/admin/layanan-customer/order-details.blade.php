@extends('layouts.admin.template-admin')

@section('title')
    <title>Daftar Detail Order | Print-Shop</title>
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
                            <strong class="card-title">Daftar Order Details</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat mencari dan mencocokkan data riwayat
                                order detail dengan order jasa milik customer.
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
                        <p class="card-title">Tabel Data Order Detail</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr class="mx-auto">
                                                <th class="text-center">No</th>
                                                <th class="text-center" width="15%">Nama Pelanggan</th>
                                                <th class="text-center">Kode Pesanan</th>
                                                <th class="text-center" width="15%">Foto Layanan</th>
                                                <th class="text-center" width="20%">Nama Layanan</th>
                                                <th class="text-center">Jumlah</th>
                                                <th class="text-center" width="10%">Total Harga</th>
                                                <th class="text-center">Estimasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $no = 1;
                                            @endphp

                                            @foreach ($list_detail_orders as $items)
                                                <tr>
                                                    <td class="text-center">{{ $no }}</td>
                                                    <td class="text-center">{{ $items->transaction_orders->user->name }}
                                                    </td>
                                                    <td class="text-center">{{ $items->transaction_order_id }}</td>
                                                    <td class="text-center"><img
                                                            src="{{ Storage::url($items->service->photo) }}"
                                                            class="img-fluid rounded" alt="Foto Jasa">
                                                    </td>
                                                    <td class="text-center">{{ $items->service->name }}</td>
                                                    <td class="text-center">{{ $items->quantity }}</td>
                                                    <td class="text-center">Rp. {{ priceConversion($items->total_price) }}
                                                    </td>
                                                    <td class="text-center">{{ dateConversion($items->deadline) }}</td>
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
