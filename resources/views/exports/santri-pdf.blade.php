<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Laporan Rekap Data Santri</title>
    <style>
        .report-title {
            text-align: center;
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            background: #fff;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
        }
        tr:nth-child(even) td {
            background: #fafafa;
        }
        body {
        font-family: DejaVu Sans, Arial, Helvetica, sans-serif;
        font-size: 10px; /* lebih kecil */
        margin: 10px;
    }
    th, td {
        border: 1px solid #444;
        padding: 3px 4px; /* lebih kecil */
        text-align: left;
        word-break: break-word; /* biar teks panjang terpotong ke bawah */
        max-width: 120px; /* batasi lebar kolom */
    }
    </style>
</head>
<body>
    <div class="report-title">Laporan Rekap Data Santri</div>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>Email</th>
                <th>Nama Lengkap</th>
                <th>NISN</th>
                <th>Tanggal Lahir</th>
                <th>Tempat Lahir</th>
                <th>Agama</th>
                <th>Jenis Kelamin</th>
                <th>Alamat</th>
                <th>Nama Ayah</th>
                <th>NIK Ayah</th>
                <th>Pendidikan Terakhir Ayah</th>
                <th>Pekerjaan Ayah</th>
                <th>No HP Ayah</th>
                <th>Nama Ibu</th>
                <th>NIK Ibu</th>
                <th>Pendidikan Terakhir Ibu</th>
                <th>Pekerjaan Ibu</th>
                <th>No HP Ibu</th>
                <th>Status Verifikasi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($santri as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->santri->nama_lengkap ?? '-' }}</td>
                <td>{{ $user->santri->nisn ?? '-' }}</td>
                <td>{{ $user->santri->tanggal_lahir ?? '-' }}</td>
                <td>{{ $user->santri->tempat_lahir ?? '-' }}</td>
                <td>{{ $user->santri->agama ?? '-' }}</td>
                <td>{{ $user->santri->jenis_kelamin ?? '-' }}</td>
                <td>{{ $user->santri->alamat ?? '-' }}</td>
                <td>{{ $user->ortu->nama_ayah ?? '-' }}</td>
                <td>{{ $user->ortu->nik_ayah ?? '-' }}</td>
                <td>{{ $user->ortu->pendidikan_terakhir_ayah ?? '-' }}</td>
                <td>{{ $user->ortu->pekerjaan_ayah ?? '-' }}</td>
                <td>{{ $user->ortu->no_hp_ayah ?? '-' }}</td>
                <td>{{ $user->ortu->nama_ibu ?? '-' }}</td>
                <td>{{ $user->ortu->nik_ibu ?? '-' }}</td>
                <td>{{ $user->ortu->pendidikan_terakhir_ibu ?? '-' }}</td>
                <td>{{ $user->ortu->pekerjaan_ibu ?? '-' }}</td>
                <td>{{ $user->ortu->no_hp_ibu ?? '-' }}</td>
                <td>{{ $user->berkas->status ?? '-' }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
