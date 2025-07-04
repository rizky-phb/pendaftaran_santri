<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>PESANTREN-SALAFIYAH</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="{{ asset('frontend/assets/img/logopondok.jpeg') }}" rel="icon-title">
    <link href="{{ asset('frontend/assets/img/logopondok.jpeg') }}" rel="icon">
    <link href="{{ asset('frontend/assets/img/logopondok.jpeg') }}" rel="logopondok">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&display=swap" rel="stylesheet">

    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('frontend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="{{ asset('frontend/assets/css/main.css') }}" rel="stylesheet">
</head>

<body class="index-page">

    <header id="header" class="header d-flex align-items-center fixed-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">

            <a href="#" class="logo d-flex align-items-center me-auto">
                <!-- Uncomment the line below if you also wish to use an image logo -->
                <img src="{{ asset('frontend/assets/img/logo-pondok.png') }}" alt="logopondok"
                    style="max-height: 50px;">
                <h1>SALAFIYAH</h1>
            </a>

            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="#hero" class="active">Home</a></li>
                    <li><a href="#alur">Alur</a></li>
                    <li><a href="#tanggal">Tanggal </a></li>
                    <li><a href="#syarat">Persayaratan Pendaftaran</a></li>
                    <li><a href="#penyerahan">Alur Penyerahan Santri</a></li>
                    <li><a href="#ekstrakulikuler">Ekstrakulikuler</a></li>
                    <li><a href="#visi & misi"><span>Visi & Misi</span></a></li>

                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>

            <a class="cta-btn" href="/user/login">Login</a>

        </div>
    </header>

    @yield('content')

    <footer id="footer" class="footer dark-background">

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="logo d-flex align-items-center">
                        <span class="sitename">Salafiyah</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>KH. Asy'ari</p>
                        <p>Drs KH. Moh. Romadhon Sz</p>
                        <p>Alamat: Jl. Kauman No 17 Kebondalem</p>
                        <p><strong>Nama Pesantren:</strong> <span>Salafiyah Kauman Pemalang</span></p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+62 8165 89033</span></p>
                        <p class="mt-3"><strong>NSP:</strong> <span>510033270004</span></p>
                        <p class="mt-3"><strong>No. Ijin Operasional:</strong> <span>024632</span></p>

                    </div>
                    <div class="social-links d-flex mt-4">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>



                <div class="col-lg-4 col-md-12 footer-newsletter">
                    <h4>Tagline</h4>
                    <p>"Warisan Ulama, Cahaya Umat"</p>
                    <form action="#" method="get" class="php-email-form" id="newsletter-form">
                    <div class="newsletter-form">
                            <input type="email" name="email" required>
                            <input type="submit" value="Subscribe">
                        </div>
                        <div class="loading" style="display:none;">Loading</div>
                        <div class="error-message" style="display:none;visibility:hidden;"></div>
                        <div class="sent-message" style="display:none;">Your subscription request has been sent. Thank you!</div>
                    </form>
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const form = document.getElementById('newsletter-form');
                            const loading = form.querySelector('.loading');
                            const sent = form.querySelector('.sent-message');
                            const error = form.querySelector('.error-message');

                            form.addEventListener('submit', function (e) {
                                e.preventDefault();
                                loading.style.display = 'block';
                                sent.style.display = 'none';
                                // error.style.display = 'none'; // Prevent error message from showing

                                setTimeout(function () {
                                    loading.style.display = 'none';
                                    sent.style.display = 'block';
                                    setTimeout(function () {
                                        window.location.reload();
                                    }, 1000); // 1 detik sebelum refresh
                                }, 1000); // loading tampil 1 detik
                            });
                        });
                    </script>
                </div>

            </div>
        </div>

        <div class="container copyright text-center mt-4">

        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    <!-- Vendor JS Files -->
    <script src="{{ asset('frontend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/php-email-form/validate.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

</body>

</html>
