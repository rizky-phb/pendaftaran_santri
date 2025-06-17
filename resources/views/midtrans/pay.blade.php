<html>

<head>
    <title>Pembayaran</title>
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}">
    </script>
</head>

<body>
    <h1>Loading pembayaran...</h1>
    <script type="text/javascript">
        snap.pay('{{ $snapToken }}', {
            onSuccess: function (result) {
                alert("Pembayaran berhasil");
                console.log(result);

                const va = result.va_numbers?.[0] || {};
                const url = `/user_pembayaran?order_id=${result.order_id}`
                    + `&transaction_id=${result.transaction_id}`
                    + `&transaction_status=${result.transaction_status}`
                    + `&payment_type=${result.payment_type}`
                    + `&transaction_time=${result.transaction_time}`
                    + `&gross_amount=${result.gross_amount}`
                    + `&fraud_status=${result.fraud_status}`
                    + `&pdf_url=${encodeURIComponent(result.pdf_url)}`
                    + `&bank=${va.bank || ''}`
                    + `&va_number=${va.va_number || ''}`;

                window.location.href = url;
            },
            onPending: function (result) {
                alert("Menunggu pembayaran");
                console.log(result);
                window.location.href = "/user";
            },
            onError: function (result) {
                alert("Terjadi kesalahan");
                console.log(result);
                window.location.href = "/user";
            },
            onClose: function () {
                alert("Kamu belum menyelesaikan pembayaran");
            }
        });
    </script>

</body>

</html>
