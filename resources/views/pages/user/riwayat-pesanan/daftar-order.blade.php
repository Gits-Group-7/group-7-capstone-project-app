@extends('layouts.user.template-user')

@section('title')
    <title>Daftar Order Jasa | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Menu Riwayat Pesanan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Daftar Riwayat Pesanan</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat mencari dan melihat Riwayat Pesanan
                                atau Daftar Order Jasa yang pernah Anda lakukan.
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
                        <p class="card-title">Tabel Daftar Order Jasa</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr class="mx-auto">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kode</th>
                                                <th class="text-center" width="15%">Foto</th>
                                                <th class="text-center">Nama Jasa</th>
                                                <th class="text-center">Quantity</th>
                                                <th class="text-center">Bahan</th>
                                                <th class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">BWX-1019</td>
                                                <td class="text-center"><img
                                                        src="{{ asset('admin/images/sample-product.jpg') }}"
                                                        class="img-fluid rounded" alt="Foto Jasa">
                                                </td>
                                                <td class="text-center">Kaos Desain Barong Vector Custom</td>
                                                <td class="text-center">5</td>
                                                <td class="text-center">Polo</td>
                                                <td class="text-center">Rp. 11.500</td>
                                            </tr>
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