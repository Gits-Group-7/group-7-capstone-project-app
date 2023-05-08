@extends('layouts.user.template-user')

@section('title')
    <title>Tracking Transaksi Produk | Print-Shop</title>
@endsection

@section('content')
    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="row justify-content-start">
                <div class="col-sm-12">
                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                        <span class="badge badge-pill badge-success px-3 py-2">Selamat Datang
                            {{ Auth::user()->name }}</span>&ensp;
                        di Menu Tracking Pesanan
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <strong class="card-title">Halaman Tracking Pesanan Produk</strong>
                            <p class="mt-2 text-secondary">Pada halaman ini Anda dapat mencari dan melihat Transaksi Produk
                                dan Status Tracking Produk Pesanan Anda.
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
                        <p class="card-title">Tabel Daftar Transaksi Produk</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table id="example" class="display expandable-table" style="width:100%">
                                        <thead>
                                            <tr class="mx-auto">
                                                <th class="text-center">No</th>
                                                <th class="text-center">Kode</th>
                                                <th class="text-center">Tanggal</th>
                                                <th class="text-center">Catatan</th>
                                                <th class="text-center">Detail Pesanan</th>
                                                <th class="text-center">Tracking Pesanan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td class="text-center">BWX-1019</td>
                                                <td class="text-center">8 Mei 2023</td>
                                                <td class="text-center">Kaos Desain Barong Vector Custom</td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-inverse-primary py-3 px-3"
                                                        data-toggle="modal" data-target="#modalDetail">Detail
                                                        Info Lain</button>
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-inverse-success py-3 px-3"
                                                        data-toggle="modal" data-target="#modalTracking">Lacak
                                                        Produk</button>
                                                </td>
                                            </tr>

                                            <!-- Modal Detail -->
                                            <div class="modal fade" id="modalDetail" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Detail Pesanan
                                                                Produk
                                                                <b>"BWX-1019"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p>
                                                                Nama Pemesan : Customer<br>
                                                                Harga Pengiriman : Rp. 50.000<br>
                                                                Status Pesanan : Sedang diproses<br>

                                                                <br>
                                                                Detail Produk :<br>
                                                                1. Kaos Jakarta Custom<br>
                                                                2. Kaos Desain Barong<br>
                                                            </p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Tracking -->
                                            <div class="modal fade" id="modalTracking" tabindex="-1" role="dialog"
                                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">Tracking Pesanan
                                                                Produk
                                                                <b>"BWX-1019"</b>
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row mb-3">
                                                                <div class="col font-weight-bold">Tanggal</div>
                                                                <div class="col font-weight-bold">Lokasi</div>
                                                                <div class="col font-weight-bold">Status</div>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col">1 Mei 2023</div>
                                                                <div class="col">Banyuwangi</div>
                                                                <div class="col">Berhasil Checkout</div>
                                                            </div>
                                                            <hr>
                                                            <div class="row mb-3">
                                                                <div class="col">3 Mei 2023</div>
                                                                <div class="col">Banyuwangi</div>
                                                                <div class="col">Sedang di Proses</div>
                                                            </div>
                                                            <hr>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-primary"
                                                                data-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

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
