@extends('layouts.admin.template-admin')

@section('title')
    <title>Update Jasa | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Halaman Update Jasa
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Form Update Data Jasa</strong>
                            <p class="mt-2 text-secondary">Silahkan ganti field data Jasa sesuai dengan yang Anda
                                perlukan.</p>
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
                    <h4 class="card-title">Form Jasa</h4>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ $action }}" class="forms-sample" method="POST"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nama</label>
                                                    <input type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        id="name" placeholder="Nama Jasa" name="name"
                                                        value="{{ $service->name }}">
                                                </div>
                                                @if ($errors->has('name'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field nama harus di isi
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="category_id">Kategori</label>
                                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                                        id="category_id" name="category_id">
                                                        <option value="">Pilih Kategori Jasa</option>
                                                        @foreach ($categories as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $service->category_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                @if ($errors->has('category_id'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *option kategori harus di pilih
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="photo">Foto</label>
                                                    <input type="file" id="photo" class="file-upload-default"
                                                        name="photo">
                                                    <div class="input-group col-xs-12">
                                                        <input type="text"
                                                            class="form-control file-upload-info @error('photo') is-invalid @enderror"
                                                            disabled placeholder="Upload Foto Jasa">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-primary"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($errors->has('photo'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field photo harus di upload
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="estimation">Estimasi Pengerjaan</label>
                                                    <select class="form-control @error('estimation') is-invalid @enderror"
                                                        id="estimation" name="estimation">
                                                        <option value="">Pilih Estimasi Pengerjaan Jasa</option>
                                                        <option value="3"
                                                            {{ $service->estimation == '3' ? 'selected' : '' }}>3 Hari
                                                        </option>
                                                        <option value="4"
                                                            {{ $service->estimation == '4' ? 'selected' : '' }}>4 Hari
                                                        </option>
                                                        <option value="5"
                                                            {{ $service->estimation == '5' ? 'selected' : '' }}>5 Hari
                                                        </option>
                                                        <option value="6"
                                                            {{ $service->estimation == '6' ? 'selected' : '' }}>6 Hari
                                                        </option>
                                                        <option value="7"
                                                            {{ $service->estimation == '7' ? 'selected' : '' }}>7 Hari
                                                        </option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('estimation'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *option estimasi harus di pilih
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_per_pcs">Harga Per Piece</label>
                                                    <input type="number"
                                                        class="form-control @error('price_per_pcs') is-invalid @enderror"
                                                        id="price_per_pcs" placeholder="Harga Jasa" name="price_per_pcs"
                                                        min="0" value="{{ $service->price_per_pcs }}">
                                                </div>
                                                @if ($errors->has('price_per_pcs'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field harga per-piece harus di isi
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="price_per_dozen">Harga Per Lusin</label>
                                                    <input type="number"
                                                        class="form-control @error('price_per_dozen') is-invalid @enderror"
                                                        id="price_per_dozen" placeholder="Harga Jasa" name="price_per_dozen"
                                                        min="0" value="{{ $service->price_per_dozen }}">
                                                </div>
                                                @if ($errors->has('price_per_dozen'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field harga per-lusin harus di isi
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="description">Deskripsi</label>
                                                    <textarea class="form-control" id="description" rows="4" name="description" placeholder="Deskripsi Service">
                                                            {{ $service->description }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                                        <a href="{{ route('service.index') }}"
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

@section('script')
    <script src="{{ asset('admin/js/file-upload.js') }}"></script>

    <script>
        const ServiceNav = document.getElementById('jasa-nav');
        ServiceNav.classList.add('active');
    </script>
@endsection
