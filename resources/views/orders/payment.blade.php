<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Pembayaran Pesanan #{{ $order->id }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <h3>Memproses Pembayaran Pesanan #{{ $order->id }}</h3>
    <p>Total: Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>

    <script type="text/javascript"
            src="https://app.sandbox.midtrans.com/snap/snap.js"
            data-client-key="{{ config('midtrans.client_key') }}">
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            snap.pay('{{ $snapToken }}', {
                onSuccess: function (result) {
                    window.location.href = "{{ route('orders.index') }}";
                },
                onPending: function (result) {
                    window.location.href = "{{ route('orders.index') }}";
                },
                onError: function (result) {
                    alert('Terjadi kesalahan saat pembayaran.');
                    console.log(result);
                    window.location.href = "{{ route('orders.index') }}";
                },
                onClose: function () {
                    window.location.href = "{{ route('orders.index') }}";
                }
            });
        });
    </script>
</body>
</html>
