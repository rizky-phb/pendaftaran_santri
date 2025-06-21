{{-- resources/views/verifikasi/form.blade.php --}}
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
                @if ($errors->has('msg'))
                    <div class="alert alert-danger">
                        {{ $errors->first('msg') }}
                    </div>
                @endif

                <form method="POST" action="{{ url('/verifikasi/' . $token) }}">
                    @csrf
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="password" class="form-label">Password Baru:</label>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                required
                            >
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- Konfirmasi Password --}}
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Konfirmasi Password:</label>
                            <input
                                type="password"
                                name="password_confirmation"
                                id="password_confirmation"
                                class="form-control"
                                required
                            >
                        </div>

                        <div class="modal-footer">
                            <a href="/" class="btn btn-secondary" style="margin-right: 15px">Kembali</a>
                            <button type="submit" class="btn btn-gradient">Verifikasi & Buat Akun</button>
                        </div>
                    </div>
                </form>

            </div>
        </section>
    </main>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script></script>
@endsection
