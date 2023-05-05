@extends('layouts.admin.template-admin')

@section('title')
    <title>Profile Admin | Print-Shop</title>

    {{-- Datedroppper JS --}}
    <script src="{{ asset('admin/js-datedropper/datedropper-javascript.js') }}"></script>
@endsection

@php
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
    
    // fungsi auto repair one word
    function underscore($string)
    {
        // Ubah string menjadi lowercase
        $string = strtolower($string);
    
        // Ganti spasi dengan underscore
        $string = str_replace(' ', '_', $string);
    
        return $string;
    }
    
    function toCamelCase($string)
    {
        $string = str_replace(' ', '', ucwords($string));
        $string = lcfirst($string);
        return $string;
    }
@endphp

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
                                    <form id="form-profile" method="POST" action="{{ $action }}"
                                        enctype="multipart/form-data">
                                        @method('put')
                                        @csrf

                                        <input type="file" name="photo" id="photo" style="display:none">
                                        <button type="button" class="btn btn-block btn-upload btn-icon-text"
                                            onclick="document.getElementById('photo').click();">
                                            <i class="ti-upload btn-icon-prepend"></i>
                                            <span id="file-name">Upload Gambar</span>
                                        </button>
                                        <button type="submit" id="save-profile" class="btn btn-block btn-success"
                                            style="display:none;">Simpan</button>

                                        <script>
                                            document.getElementById('photo').addEventListener('change', function() {
                                                document.getElementById('save-profile').style.display = 'block';
                                                document.getElementById('file-name').innerHTML = this.files[0].name;
                                            });
                                        </script>

                                        {{-- </form> --}}

                                        {{-- <div class="input-group mb-3">
                                            <input type="file" class="form-control" id="photo" name="photo">
                                        </div>

                                        <button type="submit">Submit</button> --}}
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex mt-3">
                            <div class="col-md-6 mx-auto mb-4">
                                <div class="card border">
                                    <div class="card-body">
                                        <span class="fw-medium">Ubah Biodata Diri</span>

                                        <table class="mt-4">
                                            <tr>
                                                <td>Nama</td>
                                                <td>:</td>
                                                <td>{{ $admin->name }}</td>
                                                <td><a type="button" href="#!" data-toggle="modal"
                                                        data-target="#exampleModal{{ toCamelCase($admin->name) }}"
                                                        class="text-success">Ubah</a>
                                                </td>

                                                {{-- Start Modal Nama --}}
                                                <div class="modal fade" id="exampleModal{{ toCamelCase($admin->name) }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                {{-- form update --}}
                                                                <form action="{{ $action }}" class="forms-sample"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="name">Ubah Nama</label>
                                                                        <input type="text"
                                                                            class="form-control @error('name') is-invalid @enderror"
                                                                            id="name" placeholder="Nama User"
                                                                            name="name" value="{{ $admin->name }}">
                                                                    </div>
                                                                    @if ($errors->has('name'))
                                                                        <div class="invalid feedback text-danger mb-3">
                                                                            *field nama harus di isi
                                                                        </div>
                                                                    @endif

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Nama --}}
                                            </tr>

                                            <tr>
                                                <td>Tanggal Lahir</td>
                                                <td>:</td>
                                                <td>{{ dateConversion($admin->birthdate) }}</td>
                                                <td><a href="#!" data-toggle="modal"
                                                        data-target="#exampleModal{{ $admin->birthdate }}"
                                                        class="text-success">Ubah Tanggal Lahir</a></td>

                                                {{-- Start Modal Tanggal Lahir --}}
                                                <div class="modal fade" id="exampleModal{{ $admin->birthdate }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                {{-- form update --}}
                                                                <form action="{{ $action }}" class="forms-sample"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="birthdate">Ubah Tanggal Lahir</label>
                                                                        <input type="date"
                                                                            class="form-control date-input @error('birthdate') is-invalid @enderror"
                                                                            data-dd-opt-custom-class="dd-theme-bootstrap"
                                                                            id="birthdate" placeholder="Tanggal Lahir"
                                                                            name="birthdate"
                                                                            value="{{ $admin->birthdate }}">
                                                                    </div>
                                                                    @if ($errors->has('birthdate'))
                                                                        <div class="invalid feedback text-danger mb-3">
                                                                            *field tanggal lahir harus di isi
                                                                        </div>
                                                                    @endif

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Tanggal Lahir --}}
                                            </tr>

                                            <tr>
                                                <td>Jenis Kelamin</td>
                                                <td>:</td>
                                                <td>{{ $admin->gender }}</td>
                                                <td><a href="#!" data-toggle="modal"
                                                        data-target="#exampleModal{{ $admin->gender }}"
                                                        class="text-success">Ubah</a></td>

                                                {{-- Start Modal Gender --}}
                                                <div class="modal fade" id="exampleModal{{ $admin->gender }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                {{-- form update --}}
                                                                <form action="{{ $action }}" class="forms-sample"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="gender">Ubah Jenis Kelamin</label>
                                                                        <select
                                                                            class="form-control @error('gender') is-invalid @enderror"
                                                                            id="gender" name="gender">
                                                                            <option value="">Pilih Jenis Kelamin
                                                                            </option>
                                                                            <option value="Laki-laki"
                                                                                {{ $admin->gender == 'Laki-laki' ? 'selected' : '' }}>
                                                                                Laki-laki</option>
                                                                            <option value="Perempuan"
                                                                                {{ $admin->gender == 'Perempuan' ? 'selected' : '' }}>
                                                                                Perempuan</option>
                                                                        </select>
                                                                    </div>
                                                                    @if ($errors->has('gender'))
                                                                        <div class="invalid feedback text-danger mb-3">
                                                                            *option jenis kelamin harus di pilih
                                                                        </div>
                                                                    @endif
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Gender --}}
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
                                                <td>{{ $admin->email }}</td>
                                                <td><a href="#!" data-toggle="modal"
                                                        data-target="#exampleModal{{ $admin->role }}"
                                                        class="text-success">Ubah Email</a></td>

                                                {{-- Start Modal Email --}}
                                                <div class="modal fade" id="exampleModal{{ $admin->role }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                {{-- form update --}}
                                                                <form action="{{ $action }}" class="forms-sample"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="email">Ubah Email</label>
                                                                        <input type="text"
                                                                            class="form-control @error('email') is-invalid @enderror"
                                                                            id="email" placeholder="Alamat Email"
                                                                            name="email" value="{{ $admin->email }}">
                                                                    </div>
                                                                    @if ($errors->has('email'))
                                                                        <div class="invalid feedback text-danger mb-3">
                                                                            *field email harus di isi
                                                                        </div>
                                                                    @endif

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Email --}}
                                            </tr>

                                            <tr>
                                                <td>Nomor HP</td>
                                                <td>:</td>
                                                <td>{{ $admin->phone }}</td>
                                                <td><a href="#!" data-toggle="modal"
                                                        data-target="#exampleModal{{ $admin->phone }}"
                                                        class="text-success">Ubah Nomor</a></td>

                                                {{-- Start Modal Phone --}}
                                                <div class="modal fade" id="exampleModal{{ $admin->phone }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-body">

                                                                {{-- form update --}}
                                                                <form action="{{ $action }}" class="forms-sample"
                                                                    method="POST">
                                                                    @method('put')
                                                                    @csrf

                                                                    <div class="form-group">
                                                                        <label for="phone">Ubah Nomor HP</label>
                                                                        <input type="number"
                                                                            class="form-control @error('phone') is-invalid @enderror"
                                                                            id="phone" placeholder="08xxxxxxxxxx"
                                                                            name="phone" value="{{ $admin->phone }}">
                                                                    </div>
                                                                    @if ($errors->has('phone'))
                                                                        <div class="invalid feedback text-danger mb-3">
                                                                            *field nomor telepon harus di isi
                                                                        </div>
                                                                    @endif

                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-primary"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit"
                                                                    class="btn btn-success">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- End Modal Phone --}}
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

    {{-- Inisiasi datedroppper --}}
    <script>
        dateDropper({
            selector: '.date-input',
            expandedDefault: true,
            expandable: true,
            overlay: true,
            showArrowsOnHover: true,
            autoFill: false
        });
    </script>
@endsection
