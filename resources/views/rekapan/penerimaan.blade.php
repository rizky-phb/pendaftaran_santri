<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: "Times New Roman", serif;
            font-size: 12pt;
            margin: 40px;
            color: #000;
        }

        h2,
        h4 {
            text-align: center;
            margin: 0;
        }

        hr {
            border: 1px solid black;
            margin: 10px 0 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            font-size: 11pt;
        }

        th {
            background-color: #f2f2f2;
            border: 1px solid black;
            padding: 8px;
        }

        td {
            border: 1px solid black;
            padding: 6px;
            text-align: center;
        }

        tr:nth-child(even) td {
            background-color: #f9f9f9;
        }

        .ttd {
            width: 100%;
            margin-top: 50px;
            text-align: right;
            font-size: 11pt;
        }

        .kop {
            text-align: center;
            margin-bottom: 10px;
        }

        .kop img {
            width: 60px;
            margin-bottom: 10px;
        }

        .kop h2 {
            font-size: 18pt;
        }

        .kop h4 {
            font-size: 14pt;
            font-weight: normal;
        }

        .kop p {
            margin: 4px 0;
            font-size: 10pt;
        }

        .deskripsi {
            text-align: center;
            font-size: 11pt;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="kop">
        <h2>Pondok Pesantren Salafiyah Kauman Pemalang</h2>
        <p>
            Tahun Ajaran 2025/2026<br>
            Jl. Kauman No. 12, Pemalang, Jawa Tengah<br>
            Telp: (0284) 123456 | Email: admin@salafiyahkauman.sch.id
        </p>
    </div>
    <hr>
    <h2>Rekap Penerimaan Santri Baru</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Santri</th>
                <th>Status</th>
                <th>Gelombang</th>
                <th>Tanggal Penerimaan Santri</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengumuman as $index => $data)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td style="text-align:left; padding-left:10px;">{{ $data->user->name }}</td>
                    <td>{{ ucfirst($data->status) }}</td>
                    <td>{{ $data->gelombang }}</td>
                    <td>{{ $data->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="ttd">
        Pemalang, {{ $tanggalCetak }} <br>
        Pengasuh Salafiyah Kauman Pemalang<br><br><br><br>
        <strong>{{ $pengasuh }}</strong>
    </div>
</body>

</html>
