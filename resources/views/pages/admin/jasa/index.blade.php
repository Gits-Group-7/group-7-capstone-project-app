@extends('layouts.admin.template-admin')

@section('title')
    <title>Daftar Jasa | Print-Shop</title>
@endsection

@php
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
                        di Manajemen data Jasa
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Index Tabel Data Jasa</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat menambah, mengubah dan menghapus data
                                Jasa.
                            </p>
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-around">
                                <div class="col-md-12">
                                    <a href="{{ route('service.create') }}" class="btn btn-outline-primary mt-4">Tambah
                                        Jasa</a>
                                </div>
                            </div>
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
                                            <th width="30%" class="text-center">Nama</th>
                                            <th class="text-center" width="15%">Foto</th>
                                            <th class="text-center">Kategori</th>
                                            <th class="text-center">Harga per Piece</th>
                                            <th class="text-center">Harga per Lusin</th>
                                            <th class="text-center">Estimasi</th>
                                            <th class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($services as $item)
                                            <tr class="shadow-sm">
                                                <td class="text-center">{{ $no }}</td>
                                                <td class="text-center">{{ $item->name }}</td>
                                                <td class="td-center">
                                                    <img src="{{ Storage::url($item->photo) }}" class="img-fluid rounded"
                                                        alt="{{ $item->name }}">
                                                </td>
                                                <td class="text-center">{{ $item->category->name }}</td>
                                                <td class="text-center">Rp. {{ priceConversion($item->price_per_pcs) }}</td>
                                                <td class="text-center">Rp. {{ priceConversion($item->price_per_dozen) }}
                                                </td>
                                                <td class="text-center">{{ $item->estimation }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical" role="group"
                                                        aria-label="Basic example">
                                                        <a href="{{ route('service.edit', $item->id) }}" type="button"
                                                            class="btn btn-inverse-success py-3 px-3">Edit</a>
                                                        <button type="button" class="btn btn-inverse-danger py-3 px-3"
                                                            data-toggle="modal"
                                                            data-target="#exampleModal{{ $item->id }}">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $item->id }}" tabindex="-1"
                                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Jasa
                                                                <b>"{{ $item->name }}"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                <img src="{{ Storage::url($item->photo) }}"
                                                                    class="img-fluid rounded mb-3"
                                                                    alt="{{ $item->name }}">
                                                                Nama : {{ $item->name }}<br>
                                                                Kategori : {{ $item->category->name }}<br>
                                                                Harga Per Piece : Rp.
                                                                {{ priceConversion($item->price_per_pcs) }}<br>
                                                                Harga Per Lusin : Rp.
                                                                {{ priceConversion($item->price_per_dozen) }}<br>
                                                                Estimasi Pengiriman : {{ $item->estimation }}<br>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="{{ route('service.destroy', $item->id) }}"
                                                                type="button" class="btn btn-danger">Delete</a>
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
