@extends('layouts.admin.template-admin')

@section('title')
    <title>Daftar Promo Banner | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Manajemen data Promo Banner
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Index Tabel Data Promo Banner</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat menambah, mengubah dan menghapus data
                                Promo Banner.
                            </p>
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-around">
                                <div class="col-md-12">
                                    <a href="{{ route('promo.banner.create') }}" class="btn btn-outline-primary mt-4">Tambah
                                        Promo Banner</a>
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
                                            <th class="text-center">Judul Promo</th>
                                            <th width="15%" class="text-center">Photo Banner</th>
                                            <th width="15%" class="text-center">Produk</th>
                                            <th width="15%" class="text-center">Jasa</th>
                                            <th class="text-center">Status</th>
                                            <th width="10%" class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($promo_banners as $item)
                                            <tr class="shadow-sm">
                                                <td class="text-center">{{ $no }}</td>
                                                <td class="text-center">{{ $item->title }}</td>
                                                <td class="td-center">
                                                    <img src="{{ Storage::url($item->photo) }}" class="img-fluid rounded"
                                                        alt="{{ $item->title }}">
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->product_id != null)
                                                        {{ $item->product->name }}
                                                    @else
                                                        Tidak Ada
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($item->service_id != null)
                                                        {{ $item->service->name }}
                                                    @else
                                                        Tidak Ada
                                                    @endif
                                                </td>
                                                <td class="text-center">{{ $item->status }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical" role="group"
                                                        aria-label="Basic example">
                                                        <a href="{{ route('promo.banner.edit', $item->id) }}" type="button"
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus
                                                                <b>"{{ $item->title }}"?</b>
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
                                                                    alt="{{ $item->title }}">
                                                                Judul Promo : {{ $item->title }}<br>
                                                                Status : {{ $item->status }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="{{ route('promo.banner.destroy', $item->id) }}"
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
