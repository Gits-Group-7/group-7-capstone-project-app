@extends('layouts.admin.template-admin')

@section('title')
    <title>Profile Admin | Print-Shop</title>
@endsection

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body card-hover rounded">
                        <p class="card-title">Update Data Profil Admin</p>
                        <span class="text-secondary">Pada Halaman ini Anda dapat mengubah informasi pribadi akun Anda.</span>
                        <div class="row d-flex justify-content-center">
                            <div class="col-md-4">
                                <div class="my-auto pt-5">
                                    {{-- jika user tidak memiliki foto --}}
                                    @if (Auth::user()->photo == 'empty')
                                        <img src="{{ asset('admin/images/admin-profile.png') }}" alt=""
                                            class="img-fluid rounded-circle-img border p-1">
                                    @else
                                        {{-- jika user memiliki foto --}}
                                        <img src="{{ Storage::url(Auth::user()->photo) }}" alt=""
                                            class="img-fluid rounded-circle-img border p-1">
                                    @endif
                                </div>
                                <div class="pt-3 pb-4 mx-5">
                                    <form method="POST" action="{{ route('admin.profile.update', Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf

                                        {{-- <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div> --}}
                                        <button type="button" class="btn btn-block btn-upload btn-icon-text">
                                            <i class="ti-upload btn-icon-prepend"></i>
                                            Upload Gambar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex mt-3">
                            <div class="col-md-6 mx-auto">
                                <div class="card border">
                                    <div class="card-body">
                                        <span class="fw-medium">Ubah Biodata Diri</span>
                                        <table class="mt-4">
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>Taufik Hidayat</td>
                                                <td><a href="#!" class="text-success">Ubah Nama</a></td>
                                            </tr>
                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>:</td>
                                                <td>12 September 2001</td>
                                                <td><a href="#!" class="text-success">Ubah Tanggal Lahir</a></td>
                                            </tr>
                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td>Laki-laki</td>
                                                <td><a href="#!" class="text-success">Ubah Jenis Kelamin</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mx-auto">
                                <div class="card border">
                                    <div class="card-body">
                                        <span class="fw-medium">Ubah Kontak</span>
                                        <table class="mt-4">
                                            <tr>
                                                <td>Email</td>
                                                <td>:</td>
                                                <td>taufikhidayat09121@gmail.com</td>
                                                <td><a href="#!" class="text-success">Ubah Email</a></td>
                                            </tr>
                                            <tr>
                                                <td>Nomor HP</td>
                                                <td>:</td>
                                                <td>082332743884</td>
                                                <td><a href="#!" class="text-success">Ubah Nomor HP</a></td>
                                            </tr>
                                        </table>
                                    </div>
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
    <script>
        const DashboardNav = document.getElementById('dashboard-nav');
        DashboardNav.classList.add('active');
    </script>

    <script>
        // Dapatkan tombol upload
        const uploadButton = document.querySelector('.btn-upload');

        // Tambahkan event listener ketika tombol ditekan
        uploadButton.addEventListener('click', function() {
            // Dapatkan input file
            const inputFile = document.createElement('input');
            inputFile.type = 'file';
            // Jalankan fungsi upload gambar ketika file dipilih
            inputFile.addEventListener('change', uploadGambar);
            // Klik pada input file
            inputFile.click();
        });

        // Fungsi untuk upload gambar
        function uploadGambar() {
            const file = this.files[0];
            // Lakukan pengiriman file ke server di sini
            console.log(file);
        }
    </script>
@endsection
