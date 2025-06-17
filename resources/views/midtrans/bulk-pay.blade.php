<!DOCTYPE html>
<html>
<head>
    <title>Bayar Beberapa Transaksi</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <h2>Silakan Selesaikan Pembayaran Satu per Satu</h2>

    @foreach ($snapTokens as $item)
        <div style="margin-bottom: 20px;">
            <p><strong>Jenis Pembayaran:</strong> {{ $item['pembayaran']->jenis_pembayaran }}</p>
            <p><strong>Jumlah:</strong> Rp{{ number_format($item['pembayaran']->jumlah, 0, ',', '.') }}</p>
            <button onclick="pay('{{ $item['snap_token'] }}')">Bayar</button>
        </div>
    @endforeach

    <script>
        function pay(token) {
            snap.pay(token, {
                onSuccess: function(result) {
                    alert('Pembayaran Berhasil');
                    location.reload();
                },
                onPending: function(result) {
                    alert('Menunggu Pembayaran');
                },
                onError: function(result) {
                    alert('Terjadi Kesalahan');
                },
                onClose: function() {
                    alert('Kamu belum menyelesaikan pembayaran');
                }
            });
        }
    </script>
</body>
</html>
