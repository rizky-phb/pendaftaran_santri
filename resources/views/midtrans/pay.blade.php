<!DOCTYPE html>
<html>
<head>
    <title>Bayar Midtrans</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}"></script>
</head>
<body>
    <button id="pay-button">Bayar Sekarang</button>

    <script type="text/javascript">
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function () {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    alert("Berhasil");
                    console.log(result);
                },
                onPending: function(result) {
                    alert("Menunggu pembayaran");
                    console.log(result);
                },
                onError: function(result) {
                    alert("Gagal");
                    console.log(result);
                },
                onClose: function() {
                    alert('Anda menutup tanpa menyelesaikan pembayaran');
                }
            });
        });
    </script>
</body>
</html>
