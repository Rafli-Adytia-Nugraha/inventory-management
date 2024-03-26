@extends('layouts.auth')
@section('title', 'Sign In | Velzon')
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink"
                    viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                <img src="assets/images/logo-light.png" class="d-inline-block auth-logo" alt=""
                                    height="20">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">

                            <div class="card-body p-4">
                                <div class="text-center mt-2">
                                    <h5 class="text-primary">Welcome Back !</h5>
                                    <p class="text-muted">Sign in to continue to Velzon.</p>
                                </div>
                                <div class="p-2 mt-4">
                                    <form action="{{ route('authenticate') }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username"
                                                placeholder="Enter username">
                                            <small class="form-text text-danger">{{ $errors->first('username') }}</small>

                                        </div>

                                        <div class="mb-3">
                                            <div class="float-end">
                                                <a href="{{ route('forget-password') }}" class="text-muted">Forgot
                                                    password?</a>
                                            </div>
                                            <label class="form-label" for="password">Password</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" class="form-control pe-5"
                                                    placeholder="Enter password" id="password" name="password">
                                                <button
                                                    class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                                                    type="button" id="password-addon">
                                                    <i class="ri-eye-fill align-middle" id="togglePassword"></i>
                                                </button>
                                                <small
                                                    class="form-text text-danger">{{ $errors->first('password') }}</small>
                                            </div>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="auth-remember-check"
                                                name="remember">
                                            <label class="form-check-label" for="auth-remember-check">Remember
                                                me</label>
                                        </div>


                                        <div class="mt-4">
                                            <button class="btn btn-success w-100" type="submit">Sign In</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- end card body -->
                        </div>
                        <!-- end card -->
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end auth page content -->

        <!-- footer -->
        <!-- end Footer -->
    </div>
@endsection
@section('js')
    @if (Session::has('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ Session::get('error') }}",
            });
        </script>
    @endif
@endsection
