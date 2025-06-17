@extends('layout')

@section('content')

    <head>
        <meta charset="UTF-8">
        <title>Form Pendaftaran - Modal</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap 5 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Bootstrap Icons -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            .modal-header {
                background: linear-gradient(135deg, #0d6efd, #6610f2);
                color: white;
            }

            .modal-content {
                border-radius: 1rem;
                box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
            }

            .form-control:focus {
                border-color: #6610f2;
                box-shadow: 0 0 0 0.2rem rgba(102, 16, 242, 0.25);
            }

            .btn-gradient {
                background: linear-gradient(to right, #0d6efd, #6610f2);
                color: white;
                border: none;
            }

            .btn-gradient:hover {
                opacity: 0.9;
            }
        </style>
    </head>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section dark-background">
            <div class="container py-5 text-center bg-dark">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill"></i>
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form method="POST" action="{{ route('pendaftaran.store') }}">
                    @csrf
                    <div class="modal-body">

                        {{-- NAMA LENGKAP --}}
                        <div class="mb-3">
                            <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                                   id="namaLengkap" name="nama_lengkap"
                                   placeholder="Masukkan nama Anda" required pattern="[a-zA-Z\s]{3,35}"
                                   oninput="if(this.value.length > 35) this.value = this.value.slice(0,35);"
                                   onkeydown="return !(/[0-9]/.test(event.key));"
                                   title="Nama harus 3-35 karakter (hanya huruf dan spasi)"
                                   value="{{ old('nama_lengkap') }}">
                            @error('nama_lengkap')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- EMAIL --}}
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   id="email" name="email"
                                   placeholder="nama@gmail.com" pattern="^[a-zA-Z0-9._%+-]+@gmail\.com$"
                                   oninput="if(this.value.length > 50) this.value = this.value.slice(0,50);"
                                   title="Email harus menggunakan @gmail.com dan maksimal 50 karakter"
                                   value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- NO HP --}}
                        <div class="mb-3">
                            <label for="noHp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control @error('no_hp') is-invalid @enderror"
                                   id="noHp" name="no_hp"
                                   placeholder="08xxxxxxxxxx" pattern="^08[0-9]{8,12}$"
                                   title="Nomor HP harus diawali 08 dan hanya angka (10-14 digit)"
                                   oninput="if(this.value.length > 14) this.value = this.value.slice(0,14);"
                                   onkeydown="return !(/[a-zA-Z\s]/.test(event.key));"
                                   value="{{ old('no_hp') }}" required>
                            @error('no_hp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- ALAMAT --}}
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror"
                                      id="alamat" name="alamat" rows="2"
                                      placeholder="Alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <a href="/" type="button" class="btn btn-secondary" style="margin-right: 15px">Kembali</a>
                        <button type="submit" id="kirim" class="btn btn-gradient">Kirim Pendaftaran</button>
                    </div>
                </form>

            </div>
        </section>
    </main>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
@endsection
