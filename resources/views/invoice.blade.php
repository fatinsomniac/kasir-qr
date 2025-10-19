<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - Kasir QR</title>
    <link rel="stylesheet" href="{{ asset('assets/css/invoice/struk.css') }}">
</head>

<body>
    <div class="container" id="printableArea">
        <div class="header" style="margin-bottom: 20px;">
            <h2>Kasir QR RPL</h2>
            <small>
                SMK Negeri 1 Binong
                <br>
                Kompetensi Keahlian Rekayasa Perangkat Lunak
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>Kasir</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    @foreach ($orders as $order)
                        <li> RPL Kasir QR </li>
                        <li> Nomor Pesanan: {{ $order->id }} </li>
                        <li> {{ date('Y-m-d', strtotime($order->date)) }} </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga</div>
            <div>Total</div>
        </div>
        @foreach ($orders as $order)
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;">{{ $order->quantity }} x {{ $order->item->item_name }}</div>
                <div>Rp {{ number_format($order->item->price) }} </div>
                <div>Rp {{ number_format($order->total_price) }} </div>
            </div>
        @endforeach
        <hr>
        <div class="flex-container-1" style="margin-top: 10px;">
            <div class="left">
                <ul>
                    <li>Grand Total: </li>
                    <li>Pembayaran: </li>
                    <li>Kembalian: </li>
                </ul>
            </div>
            <div class="right" style="text-align: right;">
                <?php
                    $sum = $orders->sum('total_price');
                    $pay = session('payment', 0);
                ?>
                <ul>
                    <li>Rp {{ number_format($sum) }}</li>
                    <li>Rp {{ number_format($pay) }}</li>
                    <li>Rp {{ number_format(abs($sum - $pay)) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 20px;">
            <h3>Terimakasih</h3>
            <p>Selamat menikmati</p>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
    <script src={{ asset("assets/js/invoice/print.js") }}></script>
</body>

</html>