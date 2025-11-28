<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />

    <title>Masuk Akun | SPK-SAW</title>

    <!-- Custom fonts for this template-->
    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />

    <!-- Custom styles for this template-->
    <link href="{{ url('assets/css/sb-admin-2.min.css') }}" rel="stylesheet" />
    <link rel="shortcut icon" href="{{ url('assets/img/logo/poliwangi.png') }}" type="image/x-icon">
    <!-- <link rel="icon" href="{{ url('assets/') }}img/ico/favicon.ico" type="image/x-icon"> -->
    <!-- Fav Icon -->
    {{-- <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-16x16.png') }}" sizes="16x16" /> --}}
</head>

<body class="bg-gradient-primary">
    <nav class="navbar navbar-expand-lg navbar-dark bg-white shadow-lg pb-3 pt-3 font-weight-bold">
        <div class="container justify-content-center">
            <a class="navbar-brand text-primary" style="font-weight: 900;" href="{{ url('/') }}"> <i class="fa fa-code mr-2"></i> SPK-AHP</a>
        </div>
    </nav>

        <div class="container">
        <!-- Outer Row -->
        <div class="row d-plex justify-content-center mt-1">
            <div class="col-xl-10 col-lg-12 col-md-9 mt-5">
                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Masuk Akun</h1>
                                        @if (Session::get('success'))
                                            <div class="alert alert-success" role="alert">
                                                <i class="fas fa-check-circle"></i> {{ Session::get('success') }}
                                            </div>
                                        @endif
                                        @if (!empty(session('error')))
                                            <div class="alert alert-danger text-center" role="alert">
                                                <i class="fas fa-ban"></i> {{ session('error') }}
                                            </div>
                                        @endif
                                    </div>
                                    <form class="user needs-validation" action="{{ route('auth') }}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input autocomplete="off" type="text" class="form-control form-control-user @error('input') is-invalid @enderror" id="input" placeholder="Nomor Induk Mahasiswa (NIM) atau Email" name="input"/>
                                            @error('input')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <input autocomplete="off" type="password" class="form-control form-control-user @error('password') is-invalid @enderror" id="sandi" name="password" placeholder="Sandi" />
                                            @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button name="submit" type="submit" class="btn btn-primary btn-user btn-block"><i class="fas fa-fw fa-sign-in-alt mr-1"></i> Masuk</button>
                                    </form>
                                    <hr>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('lupa-sandi')}}">Lupa Sandi?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="small" href="{{ route('registrasi') }}">Buat Akun!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
<script src="{{ url('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ url('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ url('assets/js/sb-admin-2.min.js') }}"></script>
</body>

</html>