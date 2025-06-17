@foreach ($transactions as $transaction)
<div class="mb-4 border-b pb-2">
<div style="margin-left: 20px;">
    <ul class="list-disc ml-4 space-y-1 ">
        <li class="ml-4"><strong>Order ID:</strong> {{ $transaction->order_id }}</li>
        <li class="ml-4"><strong>Transaction ID:</strong> {{ $transaction->transaction_id }}</li>
        <li class="ml-4"><strong>Status:</strong> {{ $transaction->status }}</li>
        <li class="ml-4"><strong>Jumlah:</strong> {{ $transaction->amount }}</li>
        <li class="ml-4"><strong>Metode Pembayaran:</strong> {{ $transaction->payment_type }}</li>
        <li class="ml-4"><strong>Waktu Transaksi:</strong> {{ $transaction->transaction_time }}</li>
        <li class="ml-4"><strong>Fraud Status:</strong> {{ $transaction->fraud_status }}</li>
        <li class="ml-4"><strong>Bank:</strong> {{ $transaction->bank }}</li>
        <li class="ml-4"><strong>VA Number:</strong> {{ $transaction->va_number }}</li>
    </ul>
</div>
</div>

@endforeach
