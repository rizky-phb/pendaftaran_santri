<!DOCTYPE html>
<html lang="en">
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
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
<body>

<div class="container py-5 text-center">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <form method="POST" action="{{ route('pendaftaran.store') }}">
        @csrf
        <div class="modal-body">
            <div class="mb-3">
                <label for="namaLengkap" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="namaLengkap" name="nama_lengkap" placeholder="Masukkan nama Anda" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="nama@email.com" required>
            </div>
            <div class="mb-3">
                <label for="noHp" class="form-label">Nomor HP</label>
                <input type="tel" class="form-control" id="noHp" name="no_hp" placeholder="08xxxxxxxxxx" required>
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea class="form-control" id="alamat" name="alamat" rows="2" placeholder="Alamat lengkap" required></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <a href="/" type="button" class="btn btn-secondary" style="margin-right: 15px" >Kembali</a>
            <button type="submit" id="kirim" class="btn btn-gradient">Kirim Pendaftaran</button>
        </div>
    </form>
</div>

<!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
</script>
</body>
</html>
