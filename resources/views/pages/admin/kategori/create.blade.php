@extends('layouts.admin.template-admin')

@section('title')
    <title>Tambah Kategori | POS APP</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Halaman Tambah Kategori
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Form Tambah Data Kategori</strong>
                            <p class="mt-2 text-secondary">Silahkan isi field sesuai dengan data Kategori yang ingin Anda
                                tambahkan.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h4 class="card-title">Form Kategori</h4>
                    <div class="row">

                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ $action }}" class="forms-sample" method="POST">
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text"
                                                        class="form-control  @error('name') is-invalid @enderror"
                                                        id="name" placeholder="Nama Kategori" name="name">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field nama harus di isi
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control @error('status') is-invalid @enderror"
                                                        id="status" name="status">
                                                        <option value="">Pilih Status Kategori</option>
                                                        <option value="Aktif">Aktif</option>
                                                        <option value="Tidak Aktif">Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('status'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *option status harus di pilih
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Description</label>
                                                    <textarea class="form-control" id="description" rows="3" name="description" placeholder="Deskripsi Kategori"></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Tambah</button>
                                        <a href="{{ route('category.index') }}"
                                            class="btn btn-outline-primary shadow-sm">Batal</a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
