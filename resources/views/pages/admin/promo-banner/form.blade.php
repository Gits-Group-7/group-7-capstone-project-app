@extends('layouts.admin.template-admin')

@section('title')
    <title>Update Promo Banner | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Halaman Update Promo Banner
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Form Update Data Promo Banner</strong>
                            <p class="mt-2 text-secondary">Silahkan ganti field data Promo Banner sesuai dengan yang Anda
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
                    <h4 class="card-title">Form Promo Banner</h4>
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
                                                    <label for="title">Judul</label>
                                                    <input type="text"
                                                        class="form-control @error('title') is-invalid @enderror"
                                                        id="title" placeholder="Judul Promo Banner" name="title"
                                                        value="{{ $promo_banner->title }}">
                                                </div>
                                                @if ($errors->has('title'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field judul harus di isi
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
                                                            disabled placeholder="Upload Foto Banner">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-primary"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                @if ($errors->has('photo'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *field foto harus di upload
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_id">Promo Produk (Optional)</label>
                                                    <select class="form-control" id="product_id" name="product_id">
                                                        <option value="">Pilih Produk</option>
                                                        @foreach ($products as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $promo_banner->product_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="service_id">Promo Jasa (Optional)</label>
                                                    <select class="form-control" id="service_id" name="service_id">
                                                        <option value="">Pilih Jasa</option>
                                                        @foreach ($services as $item)
                                                            <option value="{{ $item->id }}"
                                                                {{ $promo_banner->service_id == $item->id ? 'selected' : '' }}>
                                                                {{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select class="form-control @error('status') is-invalid @enderror"
                                                        id="status" name="status">
                                                        <option value="">Pilih Status Promo Banner</option>
                                                        <option value="Aktif"
                                                            {{ $promo_banner->status == 'Aktif' ? 'selected' : '' }}>Aktif
                                                        </option>
                                                        <option value="Non-Aktif"
                                                            {{ $promo_banner->status == 'Non-Aktif' ? 'selected' : '' }}>
                                                            Non-Aktif</option>
                                                    </select>
                                                </div>
                                                @if ($errors->has('status'))
                                                    <div class="invalid feedback text-danger mb-3">
                                                        *option status harus di pilih
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                                        <a href="{{ route('product.index') }}"
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
        const promoBannerNav = document.getElementById('promo-banner-nav');
        promoBannerNav.classList.add('active');
    </script>
@endsection
