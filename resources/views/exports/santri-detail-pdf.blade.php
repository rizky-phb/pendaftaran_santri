<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Data Santri</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .report-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .santri-form {
            border: 1px solid #444;
            padding: 16px 24px;
            margin-bottom: 30px;
            background: #fff;
            border-radius: 6px;
        }
        .form-row {
            display: flex;
            margin-bottom: 8px;
        }
        .form-label {
            width: 220px;
            font-weight: bold;
        }
        .form-value {
            flex: 1;
        }
        hr {
            margin: 24px 0;
            border: none;
            border-top: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div class="report-title">Laporan Rekap Data Santri</div>
    <div class="santri-form">
        <div class="form-row">
            <div class="form-label">Nama</div>
            <div class="form-value">{{ $santri->name }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Email</div>
            <div class="form-value">{{ $santri->email }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Nama Lengkap</div>
            <div class="form-value">{{ $santri->santri->nama_lengkap ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">NISN</div>
            <div class="form-value">{{ $santri->santri->nisn ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Tanggal Lahir</div>
            <div class="form-value">{{ $santri->santri->tanggal_lahir ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Tempat Lahir</div>
            <div class="form-value">{{ $santri->santri->tempat_lahir ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Agama</div>
            <div class="form-value">{{ $santri->santri->agama ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Jenis Kelamin</div>
            <div class="form-value">{{ $santri->santri->jenis_kelamin ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Alamat</div>
            <div class="form-value">{{ $santri->santri->alamat ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Nama Ayah</div>
            <div class="form-value">{{ $santri->santri->nama_ayah ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">NIK Ayah</div>
            <div class="form-value">{{ $santri->santri->nik_ayah ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Pendidikan Terakhir Ayah</div>
            <div class="form-value">{{ $santri->santri->pendidikan_terakhir_ayah ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Pekerjaan Ayah</div>
            <div class="form-value">{{ $santri->santri->pekerjaan_ayah ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">No HP Ayah</div>
            <div class="form-value">{{ $santri->santri->no_hp_ayah ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Nama Ibu</div>
            <div class="form-value">{{ $santri->santri->nama_ibu ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">NIK Ibu</div>
            <div class="form-value">{{ $santri->santri->nik_ibu ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Pendidikan Terakhir Ibu</div>
            <div class="form-value">{{ $santri->santri->pendidikan_terakhir_ibu ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Pekerjaan Ibu</div>
            <div class="form-value">{{ $santri->santri->pekerjaan_ibu ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">No HP Ibu</div>
            <div class="form-value">{{ $santri->santri->no_hp_ibu ?? '-' }}</div>
        </div>
        <div class="form-row">
            <div class="form-label">Status Verifikasi</div>
            <div class="form-value">{{ $santri->berkas->status ?? '-' }}</div>
        </div>
    </div>
</body>
</html>
