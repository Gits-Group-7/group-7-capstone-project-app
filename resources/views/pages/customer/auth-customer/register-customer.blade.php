@extends('layouts.auth.template-auth')

@section('title')
    <title>Register Account | New Customer</title>
@endsection

@section('content')
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
            <div class="content-wrapper d-flex align-items-center auth px-0 body-theme">
                <div class="row w-100 mx-0">
                    <div class="col-lg-4 mx-auto">
                        <div class="auth-form-light text-left py-5 px-4 px-sm-5 card-hover rounded">
                            <div class="mb-4">
                                <img src="{{ asset('admin/images/print-shop-logo.png') }}" width="45" alt="logo">
                            </div>
                            <h4>Buat akun baru</h4>
                            <h6 class="font-weight-light text-secondary mt-2">
                                Selamat datang pengguna baru (Customer)
                            </h6>
                            <form action="{{ route('customer.do.register') }}" class="pt-3" method="POST">
                                @csrf

                                <div class="form-group">
                                    <input type="text"
                                        class="form-control form-control-lg rounded @error('name') is-invalid @enderror"
                                        id="name" placeholder="Name" name="name">
                                    @error('name')
                                        <div id="nameHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="email"
                                        class="form-control form-control-lg rounded @error('email') is-invalid @enderror"
                                        id="email" placeholder="Email" name="email">
                                    @error('email')
                                        <div id="emailHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg rounded @error('password') is-invalid @enderror"
                                        id="password" placeholder="Password" name="password">
                                    @error('password')
                                        <div id="passwordHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <input type="password"
                                        class="form-control form-control-lg rounded @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" placeholder="Confirm Password"
                                        name="password_confirmation">
                                    @error('password_confirmation')
                                        <div id="passwordConfirmationHelp" class="form-text">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mt-3">
                                    <button type="submit"
                                        class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">DAFTAR</button>
                                </div>

                                <div class="text-center mt-4 font-weight-light">
                                    <b>Sudah punya akun?</b> <a href="{{ route('customer.login') }}"
                                        class="text-primary"><b>Login</b></a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
@endsection
