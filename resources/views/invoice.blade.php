<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice - Kasir QR</title>
    <style>
        .container {
            width: 300px;
        }
        .header {
            margin: 0;
            text-align: center;
        }
        h2, p {
            margin: 0;
        }
        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1 > div {
            text-align : left;
        }
        .flex-container-1 .right {
            text-align : right;
            width: 200px;
        }
        .flex-container-1 .left {
            width: 100px;
        }
        .flex-container {
            width: 300px;
            display: flex;
        }

        .flex-container > div {
            -ms-flex: 1;  /* IE 10 */
            flex: 1;
        }
        ul {
            display: contents;
        }
        ul li {
            display: block;
        }
        hr {
            border-style: dashed;
        }
        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
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
                    <li> RPL Kasir QR </li>
                    {{-- @foreach ($orders as $order)
                        <li> {{ $order->id }} </li>
                        <li> RPL Kasir QR </li>
                        <li> {{ date('Y-m-d', strtotime($order->date)) }} </li>
                    @endforeach --}}
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama Product</div>
            <div>Harga/Qty</div>
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
        <div class="flex-container" style="text-align: right; margin-top: 10px;">
            <div></div>
            <div>
                <ul>
                    <li>Grand Total</li>
                    <li>Pembayaran</li>
                    <li>Kembalian</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <?php $sum = 0 ?>
                @foreach($orders as $orderall)
                    <?php $sum+= $orderall->total_price ?>
                @endforeach
                <?php $pay = 50000; ?>
                <ul>
                    <li>Rp {{ number_format($sum) }} </li>
                    <li>Rp {{ number_format($pay) }}</li>
                    <li>Rp {{ number_format(abs($sum - $pay)) }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 20px;">
            <h3>Terimakasih</h3>
            <p>Selamat menikmati makanannya</p>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
</body>
</html>