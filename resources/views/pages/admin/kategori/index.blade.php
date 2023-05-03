@extends('layouts.admin.template-admin')

@section('title')
    <title>Index Kategori | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Manajemen data Kategori
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Index Tabel Data Kategori</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat menambah, mengubah dan menghapus data
                                Kategori.
                            </p>
                        </div>
                        <div class="container-fluid">
                            <div class="row justify-content-around">
                                <div class="col-md-12">
                                    <a href="{{ route('category.create') }}" class="btn btn-outline-primary mt-4">Tambah
                                        Kategori</a>
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
                                            <th width="10%" class="text-center">No</th>
                                            <th width="25%" class="text-center">Nama</th>
                                            <th width="15%" class="text-center">Jenis</th>
                                            <th class="text-center">Deskripsi</th>
                                            <th width="15%" class="text-center">Status</th>
                                            <th width="15%" class="text-center">Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $no = 1;
                                        @endphp

                                        @foreach ($categories as $item)
                                            <tr class="shadow-sm">
                                                <td class="text-center">{{ $no }}</td>
                                                <td class="text-center">{{ $item->name }}</td>
                                                <td class="text-center">{{ $item->type }}</td>
                                                <td class="text-center">{{ $item->description }}</td>
                                                <td class="text-center">{{ $item->status }}</td>
                                                <td class="text-center">
                                                    <div class="btn-group-vertical" role="group"
                                                        aria-label="Basic example">
                                                        <a href="{{ route('category.edit', $item->id) }}" type="button"
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
                                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Kategori
                                                                <b>"{{ $item->name }}"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Nama : {{ $item->name }}<br>
                                                                Description : {{ $item->description }}<br>
                                                                Status : {{ $item->status }}
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                            <a href="{{ route('category.destroy', $item->id) }}"
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
@endsection
