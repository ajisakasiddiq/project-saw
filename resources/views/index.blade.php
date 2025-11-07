<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>SPK-SAW</title>
    <link rel="icon" href="{{ url('assets/img/ico/favicon-32x32.png') }}" type="image/png">

    <!-- Google Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" rel="stylesheet">

    <!-- Vendor CSS -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">

    <!-- Custom Style -->
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #00a8cc, #007bff);
            color: white;
            overflow-x: hidden;
        }

        /* HEADER */
        #header {
            background: transparent;
            position: absolute;
            top: 0;
            width: 100%;
            z-index: 10;
            padding: 20px 0;
        }

        .logo a {
            font-size: 28px;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
        }

        .navbar a {
            color: #fff;
            text-decoration: none;
            margin-left: 20px;
            font-weight: 500;
            transition: 0.3s;
        }

        .navbar a:hover {
            color: #e3f2fd;
        }

        /* HERO SECTION */
        #hero {
            display: flex;
            align-items: center;
            min-height: 100vh;
            padding: 120px 0 60px;
            position: relative;
            overflow: hidden;
        }

        .hero-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: nowrap;
            gap: 40px;
        }

        .hero-content {
            flex: 1;
            margin-top:-100px;
            padding-right: 30px;
        }

        .hero-content h1 {
            font-size: 52px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .hero-content h2 {
            font-size: 22px;
            font-weight: 400;
            color: #e3f8ff;
            max-width: 700px;
            line-height: 1.5;
        }

        .hero-img {
            flex: 1;
            margin-top: -130px;
            display: flex;
            justify-content: center;
        }

        .hero-img img {
            max-width: 65%;
            height: auto;
            border-radius: 10px;
            /* box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3); */
        }

        /* Background Shapes */
        .shape-circle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            z-index: 1;
        }

        .shape-circle.small {
            width: 80px;
            height: 80px;
            top: 20%;
            left: 5%;
        }

        .shape-circle.large {
            width: 200px;
            height: 200px;
            bottom: -80px;
            right: -80px;
        }

        .dots {
            position: absolute;
            width: 120px;
            height: 120px;
            background-image: radial-gradient(white 2px, transparent 2px);
            background-size: 20px 20px;
            opacity: 0.2;
        }

        .dots.top {
            top: 10%;
            right: 15%;
        }

        .dots.bottom {
            bottom: 15%;
            left: 10%;
        }

        /* BUTTONS */
        .btn-primary-custom {
            background: #fff;
            color: #007bff;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            transition: 0.3s;
            text-decoration: none;
        }

        .btn-primary-custom:hover {
            background: #e3f2fd;
        }

        /* FOOTER */
        footer {
            text-align: center;
            padding: 20px;
            background: rgba(255, 255, 255, 0.1);
            font-size: 14px;
            color: #e0f7ff;
        }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .hero-container {
                flex-direction: column;
                text-align: center;
            }

            .hero-content {
                padding-right: 0;
            }

            .hero-img img {
                max-width: 30%;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header id="header">
        <div class="container d-flex align-items-center justify-content-between">
            <h1 class="logo">
                <a href="{{ asset('img/logo/poliwangi.png') }}">
                    <i class="bi bi-cloud me-2"></i>SPK-SAW
                </a>
            </h1>
            <nav class="navbar">
                @if (Route::has('auth'))
                    @auth
                        <a href="/beranda"><i class="bi bi-house-door me-1"></i> Beranda</a>
                    @else
                        <a href="/sesi"><i class="bi bi-box-arrow-in-right me-1"></i> Masuk</a>
                        <a href="/reg"><i class="bi bi-person-plus me-1"></i> Daftar</a>
                    @endauth
                @endif
            </nav>
        </div>
    </header>

    <!-- HERO -->
    <section id="hero">
        <div class="shape-circle small"></div>
        <div class="shape-circle large"></div>
        <div class="dots top"></div>
        <div class="dots bottom"></div>

        <div class="container hero-container">
            <div class="hero-content">
                <h1>Sistem Pendukung Keputusan Perhitungan UKT<br><span style="font-size:60px;"></span></h1>
                <h2>Sistem ini digunakan untuk membantu menentukan besaran UKT mahasiswa berdasarkan metode SAW di Politeknik Negeri Banyuwangi.</h2>
                @if (Route::has('auth'))
                    @auth
                        <a href="/beranda" class="btn-primary-custom mt-4 d-inline-block">Masuk ke Beranda</a>
                    @else
                        <a href="/sesi" class="btn-primary-custom mt-4 d-inline-block">Masuk Sekarang</a>
                    @endauth
                @endif
            </div>

            <div class="hero-img">
                <img src="{{ url('assets/img/logo/poliwangi.png') }}" alt="Tampilan SPK-SAW">
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        &copy; {{ date('Y') }} <strong>SPK-SAW</strong>. All Rights Reserved.
    </footer>

    <!-- JS -->
    <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</body>

</html>
