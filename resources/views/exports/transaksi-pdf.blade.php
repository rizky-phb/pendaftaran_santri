<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Transaksi Berhasil</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #000; padding: 4px 6px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Data Transaksi Berhasil</h2>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Nama User</th>
                <th>Jenis Pembayaran</th>
                <th>Jumlah</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Metode</th>
                <th>Waktu</th>
                <th>Bank</th>
                <th>VA Number</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $trx)
                @foreach($trx->pembayarans as $pembayaran)
                    <tr>
                        <td>{{ $pembayaran->user->id ?? '-' }}</td>
                        <td>{{ $pembayaran->user->name ?? '-' }}</td>
                        <td>{{ $pembayaran->jenis_pembayaran }}</td>
                        <td>{{ number_format($pembayaran->jumlah, 0, ',', '.') }}</td>
                        <td>{{ $trx->order_id }}</td>
                        <td>{{ $trx->status }}</td>
                        <td>{{ $trx->payment_type }}</td>
                        <td>{{ $trx->transaction_time }}</td>
                        <td>{{ $trx->bank }}</td>
                        <td>{{ $trx->va_number }}</td>
                    </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
</body>
</html>
