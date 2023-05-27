@extends('layouts.admin.template-admin')

@section('title')
    <title>
        Manajemen Transaksi Produk Pelanggan | Print-Shop</title>
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
                        di Manajemen data Transaksi Produk
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Data Transaksi Produk</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Admin dapat mengkonfirmasi Pesanan Transaksi
                                Produk milik Customer, dan Update Progress Pesanan (Tracking).
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
                                            <th class="text-center">Nama Pelanggan</th>
                                            <th class="text-center">Kode Transaksi</th>
                                            <th class="text-center">Tanggal Pemesanan</th>
                                            <th class="text-center">Biaya Transaksi</th>
                                            <th class="text-center">Status Pesanan</th>
                                            <th class="text-center">Update</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($list_transactions as $item)
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
                                                                data-target="#update-tracking-{{ $item->id }}">Ubah
                                                            </button>
                                                        </div>
                                                    @endif
                                                </td>
                                            </tr>

                                            <!-- Modal Konfirmasi Pesanan Produk -->
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
                                                                <span class="fw-medium">
                                                                    Jenis Pesanan :
                                                                </span>
                                                                @if ($item->type_transaction_order == 'product')
                                                                    Transaksi Produk
                                                                @elseif($item->type_transaction_order == 'service')
                                                                    Order Jasa
                                                                @endif
                                                                <br>
                                                                <span class="fw-medium">
                                                                    Harga Pesanan :
                                                                </span> Rp.
                                                                {{ priceConversion($item->total_price_transaction_order) }}<br>
                                                                <span class="fw-medium">
                                                                    Status Pesanan :
                                                                </span> {{ $item->status_delivery }}
                                                            </p>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Tutup</button>

                                                            @if ($item->order_confirmed == 'No')
                                                                <form
                                                                    action="{{ route('admin.manage.transaction.confirm', $item->id) }}"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <button type="submit" class="btn btn-success">Proses
                                                                        Pesanan</button>
                                                                </form>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Update Tracking Pesanan Produk -->
                                            <div class="modal fade" id="update-tracking-{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="prof-order-paymentLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="prof-order-paymentLabel">Update
                                                                Tracking Status Pesanan Produk
                                                                <b>"{{ $item->id }}"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="">
                                                                <div class="form-group">
                                                                    <label for="status">Status</label>
                                                                    <select
                                                                        class="form-control @error('status') is-invalid @enderror"
                                                                        id="status" name="status">
                                                                        <option value="">Pilih Status Pesanan
                                                                        </option>
                                                                        <option value="Pesanan Diproses">Pesanan Diproses
                                                                        </option>
                                                                        <option value="Pesanan Dikirim">Pesanan Dikirim
                                                                        </option>
                                                                        <option value="Pesanan Dalam Perjalanan">Pesanan
                                                                            Dalam Perjalanan
                                                                        </option>
                                                                        <option value="Pesanan Selesai">Pesanan Selesai
                                                                        </option>
                                                                        <option value="Pesanan Tertunda">Pesanan Tertunda
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                @if ($errors->has('status'))
                                                                    <div class="invalid feedback text-danger mb-3">
                                                                        *option status harus di pilih
                                                                    </div>
                                                                @endif

                                                                <div class="form-group">
                                                                    <label for="location">Lokasi</label>
                                                                    <input type="text"
                                                                        class="form-control @error('location') is-invalid @enderror"
                                                                        id="location" placeholder="Lokasi Pesanan"
                                                                        name="location">
                                                                </div>
                                                                @if ($errors->has('location'))
                                                                    <div class="invalid feedback text-danger mb-3">
                                                                        *field lokasi harus di isi
                                                                    </div>
                                                                @endif

                                                                <div class="form-group">
                                                                    <label for="is_complete">Pesanan Selesai</label>
                                                                    <select
                                                                        class="form-control @error('is_complete') is-invalid @enderror"
                                                                        id="is_complete" name="is_complete">
                                                                        <option value="">Apakah Pesanan Selesai
                                                                        </option>
                                                                        <option value="No">Belum Selesai</option>
                                                                        <option value="Yes">Selesai</option>
                                                                    </select>
                                                                </div>
                                                                @if ($errors->has('is_complete'))
                                                                    <div class="invalid feedback text-danger mb-3">
                                                                        *option pesanan selesai harus di pilih
                                                                    </div>
                                                                @endif

                                                                <div class="form-group">
                                                                    <label for="note">Catatan Pesanan <span
                                                                            class="text-primary">(*optional)</span></label>
                                                                    <textarea class="form-control" id="note" rows="4" name="note"
                                                                        placeholder="Berikan cacatan log pesanan"></textarea>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Tutup</button>

                                                            <button type="submit" class="btn btn-success">Update
                                                                Tracking</button>
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
