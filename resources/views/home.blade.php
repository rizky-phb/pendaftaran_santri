@extends('layout')

@section('content')
    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">

            <img src="{{ asset('frontend/assets/img/Hero_Pesantren_Salafiyah_Kauman.jpg') }}" alt=""
                data-aos="fade-in">

            <div class="container d-flex flex-column align-items-center">
                <h2 data-aos="fade-up" data-aos-delay="100">"SALAFIYAH"</h2>
                <p data-aos="fade-up" data-aos-delay="200">"PONDOK PESANTREN /MADRASAH DINIYAH WUSTHO/ ULYA PUTRA-PUTRI"</p>
                <div class="d-flex mt-4" data-aos="fade-up" data-aos-delay="300">
                    <a href="/form-pendaftaran" class="btn-get-started">Ayo Bergabung</a>
                    <a href="https://www.youtube.com/watch?v=mza4qE7QHaI&t=25s"
                        class="glightbox btn-watch-video d-flex align-items-center"><i
                            class="bi bi-play-circle"></i><span>Watch Video</span></a>
                </div>
            </div>

        </section><!-- /Hero Section -->

        <!-- About Section -->
        <section id="about" class="about section">

            <div class="container">

                <div class="row gy-4">
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <h3>Tentang Kami</h3>
                        <img src="{{ asset('frontend/assets/img/tentangkami3.jpg') }}"
                            class="img-fluid rounded-4 mb-4 w-100" style="max-width: 800px" alt="about">
                        <p>Pondok Pesantren Salafiyah yang dirintis oleh KH. Asy’ari bersama putra-putranya dan
                            keponakannya, diantaranya yaitu : KH. Shidiq, KH. Mudhofir, KH. Makhmud, KH. Abdul Karim, pondok
                            Pesantren Salafiyah di dirikan pada tahun 1933 M. Pada saat itu pondok dibangun dengan pagar
                            bambu sederhana sebanyak 2 kamar.Seiring berjalannya waktu pada tahun 1943 Pondok Pesantren
                            Salafiyah Kauman Pemalang mengalami perubahan yaitu direnovasinya bangunan pondok yang asalnya
                            menggunakan bambu diganti tembok dan penambahan kamar pondok dikarenakan semakin banyaknya
                            santri yang mendaftar di pondok pesantren Salafiyah Kauman Pemalang.</p>
                        <p>Kemudian Sistem pendidikan yang diajarkan oleh KH Asy’ari di Pondok Pesantren Salafiyah
                            menggunakan sistem klasikal yaitu sistem pendidikan tradisional (salaf) yang berupa bandongan,
                            sorogan, halaqoh. Kemudian Setelah wafatnya KH. Asy’ari pada tahun 1952 penerus perjuangan KH
                            Asy’ari diteruskan oleh putra-putranya yaitu KH. Shidiq Asy’ari, KH. Mudlofir Asy’ari, KH.
                            Mahmud Asy’ari, KH. Abdul Karim Asy’ari, KH. Zuhdi sejak tahun 1953-1959.</p>
                    </div>
                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="250">
                        <div class="content ps-0 ps-lg-5">
                            <h4 class="mb-4">
                                Fasilitas
                            </h4>
                            <ul>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Gedung Pesantren.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Masjid.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Perpustakaan.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Laboratorium IPA.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Koperasi.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Laboratorium Komputer.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Gedung Sekolah.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Klinik Bahasa.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Laboratorium Bahasa.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Gudang.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Kantin.</span></li>
                                <li><i class="bi bi-check-circle-fill"></i> <span>Perkantoran.</span></li>
                            </ul>
                            <p>
                                Yang awal mulanya dari tahun 1959 sampai tahun 1985 jumlah santri yang menetap di pondokan
                                kurang lebih mencapai 20%, santri kalong yang belajar khusus madrasah mencapai 30%.Kemudian
                                pada tahun 1985 sampai tahun 2001 (Pengasuh KH Sya’ban Zuhdi, KH. Abdullah Shidiq, KH.
                                M.Hasan Shidiq dan KH. Sya’roni) jumlah santri yang menetap di pondokan meningkat dari 20%
                                menjadi 80% yang terdiri santri yang khusus mengaji 60 % dan santri yang mengaji dan sekolah
                                umum 40% dan jumlah santri kalong yang khusus belajar di madrasah dari 30% meningkat menjadi
                                50%. Semakin majunya perkembangan pendidikan pesantren, semakin banyaknya jumlah santri yang
                                menetap di pondok.
                            </p>

                            <div class="position-relative mt-4">
                                <img src="{{ asset('frontend/assets/img/ponpes-salafiyah.jpg') }}"
                                    class="img-fluid rounded-4" alt="">
                                <a href="https://youtu.be/mza4qE7QHaI?si=CnyKBiLXN-2tXIQy"
                                    class="glightbox pulsating-play-btn"></a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </section><!-- /About Section -->
        <!-- Stats Section -->
        <section id="stats" class="stats section py-5" style="background-color: #f1f8f5;">
            <div class="container" data-aos="fade-up">

                <div class="row gy-4 text-center">

                    <!-- Item 1 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item bg-white p-4 rounded-4 shadow-sm h-100 transition-hover" data-aos="zoom-in"
                            data-aos-delay="100">
                            <i class="bi bi-person-fill-check text-success fs-1 mb-3"></i>
                            <h3 class="purecounter text-dark fw-bold" data-purecounter-start="0" data-purecounter-end="171"
                                data-purecounter-duration="1">0</h3>
                            <p class="text-muted mb-0">Jumlah Santri</p>
                        </div>
                    </div>

                    <!-- Item 2 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item bg-white p-4 rounded-4 shadow-sm h-100 transition-hover" data-aos="zoom-in"
                            data-aos-delay="200">
                            <i class="bi bi-person-lines-fill text-primary fs-1 mb-3"></i>
                            <h3 class="purecounter text-dark fw-bold" data-purecounter-start="0" data-purecounter-end="12"
                                data-purecounter-duration="1">0</h3>
                            <p class="text-muted mb-0">Jumlah Guru</p>
                        </div>
                    </div>

                    <!-- Item 3 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item bg-white p-4 rounded-4 shadow-sm h-100 transition-hover" data-aos="zoom-in"
                            data-aos-delay="300">
                            <i class="bi bi-bank2 text-warning fs-1 mb-3"></i>
                            <h3 class="purecounter text-dark fw-bold" data-purecounter-start="0" data-purecounter-end="3"
                                data-purecounter-duration="1">0</h3>
                            <p class="text-muted mb-0">Lembaga Dikelola</p>
                        </div>
                    </div>

                    <!-- Item 4 -->
                    <div class="col-lg-3 col-md-6">
                        <div class="stats-item bg-white p-4 rounded-4 shadow-sm h-100 transition-hover" data-aos="zoom-in"
                            data-aos-delay="400">
                            <i class="bi bi-star-fill text-danger fs-1 mb-3"></i>
                            <h3 class="purecounter text-dark fw-bold" data-purecounter-start="0" data-purecounter-end="12"
                                data-purecounter-duration="1">0</h3>
                            <p class="text-muted mb-0">Ekstrakurikuler</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- Program Section -->
        <section id="services" class="services section">
            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Program</h2>
                <p>Pendidikan<br></p>
            </div><!-- End Section Title -->

            <div class="container py-5" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center gy-4">

                    <!-- Loop Start -->
                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="{{ asset('frontend/assets/img/smpsalafiyah.jpg') }}"
                                        class="img-fluid rounded-start h-100 object-fit-cover" alt="Pendidikan Formal">
                                </div>
                                <div class="col-md-7 d-flex flex-column justify-content-center p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-activity text-primary fs-3 me-2"></i>
                                        <h4 class="mb-0">Pendidikan Formal</h4>
                                    </div>
                                    <p class="text-muted mb-0">SMP Plus Salafiyah Pemalang</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-0 shadow-lg h-100">
                            <div class="row g-0">
                                <div class="col-md-5">
                                    <img src="{{ asset('frontend/assets/img/majelistaklim.jpg') }}"
                                        class="img-fluid rounded-start h-100 object-fit-cover"
                                        alt="Pendidikan Non Formal">
                                </div>
                                <div class="col-md-7 d-flex flex-column justify-content-center p-4">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-broadcast text-success fs-3 me-2"></i>
                                        <h4 class="mb-0">Pendidikan Non Formal</h4>
                                    </div>
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="bi bi-book-half text-primary me-2 fs-5"></i>
                                            <span>Tahfid Qur'an</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <i class="bi bi-moon-stars-fill text-success me-2 fs-5"></i>
                                            <span>Madrasah Diniyah</span>
                                        </li>
                                        <li class="d-flex align-items-center">
                                            <i class="bi bi-people-fill text-warning me-2 fs-5"></i>
                                            <span>Majelis Taklim</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Loop End -->
                </div>
            </div>
        </section><!-- /Program Section -->

        <!-- Clients Section -->
        <!-- /Clients Section -->

        <!-- Visi & Misi Section -->
        <section id="visi & misi" class="features section">

            <div class="container">

                <ul class="nav nav-tabs row  d-flex" data-aos="fade-up" data-aos-delay="100">
                    <li class="nav-item col-3">
                        <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#features-tab-1">
                            <i class="bi bi-globe"></i>
                            <h4 class="d-none d-lg-block">Visi</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-2">
                            <i class="bi bi-list-check"></i>
                            <h4 class="d-none d-lg-block">Misi</h4>
                        </a>
                    </li>
                    {{-- <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-3">
                            <i class="bi bi-brightness-high"></i>
                            <h4 class="d-none d-lg-block">Pariatur explica nitro dela</h4>
                        </a>
                    </li>
                    <li class="nav-item col-3">
                        <a class="nav-link" data-bs-toggle="tab" data-bs-target="#features-tab-4">
                            <i class="bi bi-command"></i>
                            <h4 class="d-none d-lg-block">Nostrum qui dile node</h4>
                        </a>
                    </li> --}}
                </ul><!-- End Tab Nav -->

                <div class="tab-content" data-aos="fade-up" data-aos-delay="200">

                    <div class="tab-pane fade active show" id="features-tab-1">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Adapun visi dari pondok pesantren salafiyah ini sebagai berikut : </h3>

                                <ul>
                                    <li><i class="bi bi-check2-all"></i>
                                        <spab>Menjadikan santri sebagai manusia yang bertaqwa</spab>
                                    </li>
                                    <li><i class="bi bi-check2-all"></i> <span>Menjadikan santri sebagai manusia yang
                                            cerdas.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Menjadikan santri sebagai manusia yang
                                            terampil.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Menjadikan santri sebagai manusia yang
                                            sehat.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('frontend/assets/img/visi.jpg') }}" alt=""
                                    class="img-fluid w-100" style="max-height: 600px; object-fit:cover;">
                            </div>
                        </div>
                    </div><!-- End Tab Content Item -->

                    <div class="tab-pane fade" id="features-tab-2">
                        <div class="row">
                            <div class="col-lg-6 order-2 order-lg-1 mt-3 mt-lg-0">
                                <h3>Adapun misi dari pondok pesantren salafiyah kauman pemalang juga sebagai berikut : </h3>

                                <ul>
                                    <li><i class="bi bi-check2-all"></i> <span>Menyelenggarakan pendidikan agama yang
                                            mendalam dan berkelanjutan untuk membentuk santri yang memiliki akidah yang kuat
                                            serta akhlak mulia dalam kehidupan sehari-hari.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Mengembangkan kurikulum terpadu berbasis
                                            ilmu pengetahuan dan teknologi, serta memberikan bimbingan akademik yang
                                            intensif guna mencetak santri yang cerdas, kritis, dan berwawasan luas.</span>
                                    </li>
                                    <li><i class="bi bi-check2-all"></i> <span>Menyediakan pelatihan keterampilan hidup
                                            (life skills) seperti kewirausahaan, teknologi informasi, pertanian, dan
                                            kerajinan tangan, sehingga santri memiliki kemampuan aplikatif dan siap mandiri
                                            di masyarakat.</span></li>
                                    <li><i class="bi bi-check2-all"></i> <span>Melaksanakan program kesehatan berkala,
                                            olahraga rutin, dan edukasi pola hidup sehat, serta menyediakan fasilitas yang
                                            mendukung kebersihan dan kesehatan santri.</span></li>
                                </ul>
                            </div>
                            <div class="col-lg-6 order-1 order-lg-2 text-center">
                                <img src="{{ asset('frontend/assets/img/misi.jpg') }}" alt=""
                                    class="img-fluid w-100" style="max-height: 600px; object-fit:cover;">
                            </div>
                        </div>
                    </div>
                </div>
        </section><!-- /Features Section -->

        <!-- Program & Keunggulan Section -->
        <section id="services-2" class="services-2 section" style="background-color: #f3fdf4;">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2 style="color: #2e7d32;">Program & Keunggulan</h2>
                <p style="color: #4caf50;">Pesantren Salafiyah Kauman Pemalang</p>
            </div><!-- End Section Title -->

            <div class="container">
                <div class="row gy-4">

                    <!-- Program Unggulan 1 -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-book-half icon flex-shrink-0" style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Tafaqquh Fiddin</h4>
                                <p class="description">Pendalaman ilmu agama melalui kajian kitab kuning secara talaqqi
                                    bersama para asatidz dan kyai.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Program Unggulan 2 -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-journal-richtext icon flex-shrink-0"
                                style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Tahfidz Al-Qur'an</h4>
                                <p class="description">Program hafalan Al-Qur’an dengan metode setor harian dan bimbingan
                                    intensif dari ustadz pembimbing.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kegiatan Harian -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-calendar-check icon flex-shrink-0"
                                style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Kegiatan Harian Santri</h4>
                                <p class="description">Shalat berjamaah, ngaji kitab, setoran hafalan, muhadoroh, piket
                                    kebersihan dan kegiatan keasramaan lainnya.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Bahasa Arab -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-chat-left-text icon flex-shrink-0"
                                style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Pengembangan Bahasa Arab</h4>
                                <p class="description">Melatih percakapan harian (muhadatsah), memperdalam nahwu dan sharaf
                                    untuk menunjang pemahaman kitab kuning.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kenapa Memilih -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-emoji-smile icon flex-shrink-0" style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Kenapa Memilih Kami?</h4>
                                <p class="description">Bimbingan langsung dari kyai, lingkungan religius, tradisi salafiyah
                                    murni, dan alumni tersebar di berbagai bidang dakwah.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Kompetensi Lulusan -->
                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item d-flex position-relative h-100">
                            <i class="bi bi-award-fill icon flex-shrink-0" style="color: #388e3c; font-size: 2rem;"></i>
                            <div>
                                <h4 class="title">Kompetensi Lulusan</h4>
                                <p class="description">Menguasai ilmu agama, mampu membaca kitab gundul, hafal Al-Qur’an,
                                    serta berakhlak dan siap berdakwah di masyarakat.</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section><!-- /Program & Keunggulan Section -->



        <!-- Ekstrakulikuler Section -->
        <section id="ekstrakulikuler" class="portfolio section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Ekstrakulikuler</h2>
                <p>Kegiatan Ekstrakulikuler</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">

                    <ul class="portfolio-filters isotope-filters" data-aos="fade-up" data-aos-delay="100">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".filter-hadroh">Hadroh</li>
                        <li data-filter=".filter-tilawatil-quran">Seni Baca Al-Qur'an</li>
                        <li data-filter=".filter-ziarah">Ziarah & Wisata Religi</li>
                        <li data-filter=".filter-marching-band">Marching Band</li>
                        <li data-filter=".filter-pramuka">Pramuka</li>
                    </ul><!-- End Portfolio Filters -->

                    <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-hadroh">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('frontend/assets/img/ekstrakulikuler/hadroh.jpg') }}"
                                    class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>Hadroh</h4>
                                    <p>Ekstrakulikuler Hadroh</p>
                                    <a href="{{ asset('frontend/assets/img/ekstrakulikuler/hadroh.jpg') }}"
                                        title="App 1" data-gallery="portfolio-gallery-app"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-ziarah">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('frontend/assets/img/ekstrakulikuler/wisata-ziarah.jpg') }}"
                                    class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>Wisata / Ziarah</h4>
                                    <p>Ziarah Makam / Wisata Religi</p>
                                    <a href="{{ asset('frontend/assets/img/ekstrakulikuler/wisata-ziarah.jpg') }}"
                                        title="App 1" data-gallery="portfolio-gallery-app"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-marching-band">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('frontend/assets/img/ekstrakulikuler/marching-band-pesantren.jpg') }}"
                                    class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>Marching Band</h4>
                                    <p>Ekstrakulikuler Marching Band Pesantren Salafiyah Kauman</p>
                                    <a href="{{ asset('frontend/assets/img/ekstrakulikuler/marching-band-pesantren.jpg') }}"
                                        title="Branding 1" data-gallery="portfolio-gallery-branding"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-pramuka">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('frontend/assets/img/ekstrakulikuler/pramuka-pesantren.jpg') }}"
                                    class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>Pramuka</h4>
                                    <p>Kegiatan Ekstrakulikuler Pramuka Pesantren</p>
                                    <a href="{{ asset('frontend/assets/img/ekstrakulikuler/pramuka-pesantren.jpg') }}"
                                        title="Branding 2" data-gallery="portfolio-gallery-branding"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                        <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-tilawatil-quran">
                            <div class="portfolio-content h-100">
                                <img src="{{ asset('frontend/assets/img/ekstrakulikuler/tilawatil-quran.jpeg') }}"
                                    class="img-fluid" alt="">
                                <div class="portfolio-info">
                                    <h4>Tilawah Alquran</h4>
                                    <p>Ekstrakulikuler Tilawah Alqur'an</p>
                                    <a href="{{ asset('frontend/assets/img/ekstrakulikuler/tilawatil-quran.jpeg') }}"
                                        title="Branding 3" data-gallery="portfolio-gallery-book"
                                        class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                    <a href="portfolio-details.html" title="More Details" class="details-link"><i
                                            class="bi bi-link-45deg"></i></a>
                                </div>
                            </div>
                        </div><!-- End Portfolio Item -->

                    </div><!-- End Portfolio Container -->

                </div>

            </div>

        </section><!-- /Ekstrakulikuler Section -->
        <!-- Team Section -->
        <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>PENGURUS</h2>
                <p>PENGURUS</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="pic"><img src="{{ asset('frontend/assets/img/team/KH. Moh Romadlon SZ (Pengasuh Pondok).jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>KH. Moh Romadlon SZ </h4>
                                <span>Pengasuh Pondok</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- Team Section -->
        <section id="team" class="team section light-background">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>PENGURUS</h2>
                <p>PENGASUH</p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-5">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="member">
                            <div class="pic"><img src="{{ asset('frontend/assets/img/team/Kyai Miftachundin, S.Ag (Pengurus Pondok).jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Kyai Miftachundin, S.Ag</h4>
                                <span>Pengurus Pondok</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="member">
                            <div class="pic"><img src="{{ asset('frontend/assets/img/team/H. Salman Al Farisi (Pengurus Pondok).jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>H. Salman Al Farisi</h4>
                                <span>Pengurus Pondok</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="pic"><img src="{{ asset('frontend/assets/img/team/Kyai Akhmad Syaikhu, S.Ag (Pengurus Pondok).jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>Kyai Akhmad Syaikhu, S.Ag</h4>
                                <span>Pengurus Pondok</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="member">
                            <div class="pic"><img src="{{ asset('frontend/assets/img/team/H. Akhmad Khamdan (Pengurus Pondok).jpg') }}"
                                    class="img-fluid" alt="">
                            </div>
                            <div class="member-info">
                                <h4>H. Akhmad Khamdan</h4>
                                <span>Pengurus Pondok</span>
                                <div class="social">
                                    <a href=""><i class="bi bi-twitter-x"></i></a>
                                    <a href=""><i class="bi bi-facebook"></i></a>
                                    <a href=""><i class="bi bi-instagram"></i></a>
                                    <a href=""><i class="bi bi-linkedin"></i></a>
                                </div>
                            </div>
                        </div>
                    </div><!-- End Team Member -->

                </div>

            </div>

        </section><!-- /Team Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak</h2>
                <p>Hubungi Kami</p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">
                    <div class="col-lg-6 ">
                        <div class="row gy-4">

                            <div class="col-lg-12">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="200">
                                    <i class="bi bi-geo-alt"></i>
                                    <h3>Alamat</h3>
                                    <p>Jl.Kauman No.17 Kebondalem, Kebondalem, Kec. Pemalang, Kab. Pemalang Prov. Jawa
                                        Tengah</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="300">
                                    <i class="bi bi-telephone"></i>
                                    <h3>Telepon</h3>
                                    <p>+62 8165 89033</p>
                                </div>
                            </div><!-- End Info Item -->


                            <div class="col-md-6">
                                <div class="info-item d-flex flex-column justify-content-center align-items-center"
                                    data-aos="fade-up" data-aos-delay="400">
                                    <i class="bi bi-envelope"></i>
                                    <h3>Email Us</h3>
                                    <p>info@example.com</p>
                                </div>
                            </div><!-- End Info Item -->
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                            data-aos-delay="500">
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <input type="text" name="name" class="form-control" placeholder="Nama"
                                        required="">
                                </div>

                                <div class="col-md-6 ">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" name="subject" placeholder="Subject"
                                        required="">
                                </div>

                                <div class="col-md-12">
                                    <textarea class="form-control" name="message" rows="4" placeholder="Pesan" required=""></textarea>
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Pesan anda telah terkirim. Terima Kasiih!</div>

                                    <button type="submit">Kirim</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>
@endsection
