<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SPK-AHP</title>
    <meta name="description">
    <meta name="keywords">

    <link rel="shortcut icon" href="{{ url('assets/img/ico/favicon.ico') }}" type="image/x-icon">
    <!-- <link rel="icon" href="{{ url('assets/') }}img/ico/favicon.ico" type="image/x-icon"> -->
    <!-- Fav Icon -->
    <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-32x32.png') }}" sizes="32x32" />
    <link rel="icon" type="image/png" href="{{ url('assets/img/ico/favicon-16x16.png') }}" sizes="16x16" />

    <link href="{{ url('assets/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ url('assets/css/style.css')}}" rel="stylesheet">

</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center justify-content-between">

            <h1 class="logo font-weight-bold"><a href="{{ url('/') }}"><i class="fa fa-code mr-2"></i> SPK-AHP</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar">
                <ul>
                    @if (Route::has('auth'))
                        @auth
                        <li><a class="nav-link" href="/beranda">Beranda</a></li>
                        @else
                        <li><a class="nav-link" href="/sesi">Masuk</a></li>
                        <li><a class="nav-link" href="/reg">Daftar</a></li>
                        @endauth
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex section-bg align-items-center mt-5">
        <div class="container position-relative">
            <div class="row justify-content-center">
                <div class="col-xl-7 col-lg-9 text-center">
                    <h1>SPK-AHP</h1>
                    <h2>SISTEM PENDUKUNG KEPUTUSAN PENERIMAAN
                                            PERMOHONAN PENYESUAIAN UKT BAGI
                                            MAHASISWA POLITEKNIK NEGERI
                                            JEMBER</h2>
                </div>
            </div>
            <div class="text-center">
                @if (Route::has('auth'))
                    @auth
                    <a href="/beranda" class="btn-get-started">Beranda</a>
                    @else
                    <a href="/sesi" class="btn-get-login">Masuk</a>
                    <a href="/reg" class="btn-get-regis">Daftar</a>
                    @endauth
                @endif
            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Services Section ======= -->
        <section id="services" class="services section-bg mt-5">
            <div class="container">

                <div class="section-title">
                    <h2>Fitur</h2>
                    <p>Mahasiswa dapat melakukan pendaftaran terkait Pengangsuran UKT atau Penurunan UKT dengan ketentuan di bawah ini.</p>
                </div>
                    
                <div class="row">
                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box iconbox-yellow">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,503.46388370962813C374.79870501325706,506.71871716319447,464.8034551963731,527.1746412648533,510.4981551193396,467.86667711651364C555.9287308511215,408.9015244558933,512.6030010748507,327.5744911775523,490.211057578863,256.5855673507754C471.097692560561,195.9906835881958,447.69079081568157,138.11976852964426,395.19560036434837,102.3242989838813C329.3053358748298,57.3949838291264,248.02791733380457,8.279543830951368,175.87071277845988,42.242879143198664C103.41431057327972,76.34704239035025,93.79494320519305,170.9812938413882,81.28167332365135,250.07896920659033C70.17666984294237,320.27484674793965,64.84698225790005,396.69656628748305,111.28512138212992,450.4950937839243C156.20124167950087,502.5303643271138,231.32542653798444,500.4755392045468,300,503.46388370962813"></path>
                                </svg>
                                <i class="bx bx-layer"></i>
                            </div>
                            <h4>Pengangsuran UKT</h4>
                            <p>Bagi yang ekonomi tidak stabil, dapat untuk mendaftar hak mengangsur UKT selama beberapa bulan.</p>
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6 d-flex align-items-stretch mt-4">
                        <div class="icon-box iconbox-orange ">
                            <div class="icon">
                                <svg width="100" height="100" viewBox="0 0 600 600" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke="none" stroke-width="0" fill="#f5f5f5" d="M300,582.0697525312426C382.5290701553225,586.8405444964366,449.9789794690241,525.3245884688669,502.5850820975895,461.55621195738473C556.606425686781,396.0723002908107,615.8543463187945,314.28637112970534,586.6730223649479,234.56875336149918C558.9533121215079,158.8439757836574,454.9685369536778,164.00468322053177,381.49747125262974,130.76875717737553C312.15926192815925,99.40240125094834,248.97055460311594,18.661163978235184,179.8680185752513,50.54337015887873C110.5421016452524,82.52863877960104,119.82277516462835,180.83849132639028,109.12597500060166,256.43424936330496C100.08760227029461,320.3096726198365,92.17705696193138,384.0621239912766,124.79988738764834,439.7174275375508C164.83382741302287,508.01625554203684,220.96474134820875,577.5009287672846,300,582.0697525312426"></path>
                                </svg>
                                <i class="bx bx-file"></i>
                            </div>
                            <h4>Penurunan UKT</h4>
                            <p>Bagi mahasiswa yang merasa UKT tidak sesuai dengan kondisi ekonomi keluarga atau memberatkan, dapat mengajukan penurunan UKT.</p>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Sevices Section -->

    </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <footer id="footer">
        <div class="container py-4">
            <div class="copyright">
                <div class="row">
                    <div class="col-sm-6 text-left">
                        &copy; Copyright <?= date('Y') ?> <strong><span>SPK-AHP</span></strong>. All Rights Reserved
                    </div>
                    <div class="col-sm-6 text-right">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </div>
                </div>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Template Main JS File -->
    <script src="{{ url('assets/js/main.js')}}"></script>

</body>

</html>