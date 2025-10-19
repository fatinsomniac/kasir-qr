<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Semua QR Code</title>
    <link rel="stylesheet" href={{ asset('assets/css/default.css') }}>
    <link rel="stylesheet" href={{ asset('assets/css/items/all-qrcodes.css') }}>

    <style>
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
        }

        .header h1 {
            color: #2c3e50;
        }

        .header p {
            margin: 5px 0;
            color: #7f8c8d;
        }

        /* QR Items Grid - FIXED */
        .qr-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            /* Penting untuk konsistensi */
        }

        body .qr-table .qr-item {
            width: 33.33%;
            text-align: center;
            padding: 20px 10px;
            border: 1px solid #ecf0f1;
            page-break-inside: avoid;
            vertical-align: middle;
            height: 200px;
        }

        body .qr-table .qr-item h4{
            text-align: center;
            page-break-inside: avoid;
            vertical-align: middle;
        }

        .qr-box {
            text-align: center;
            display: block;
            margin: 0 auto;
            max-width: 150px;
        }

        .qr-box img {
            display: block;
            margin: 0 auto 10px auto;
        }

        .uuid {
            font-family: monospace;
            font-size: 10px;
            word-break: break-all;
            margin: 5px 0 0 0;
            line-height: 1.2;
        }

        .page-break {
            page-break-after: always;
            height: 0;
        }

        /* Force new row setelah 3 items */
        .new-row {
            display: table-row;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ecf0f1;
            font-size: 12px;
            color: #95a5a6;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Semua QR Code</h1>
        <p>Total item yang tersedia: {{ $items->count() }}</p>
    </div>

    <table class="qr-table">
        @foreach($items->chunk(3) as $chunkIndex => $row)
            <tr>
                @foreach($row as $item)
                    <td class="qr-item">
                        <h4>{{ $item->item_name }}</h4>
                        <img src="{{ storage_path('app/public/' . $item->qrcode_path) }}" width="100" height="100" alt="QR Code"
                            style="display: block; margin: 0 auto 10px auto;">

                        <p style="margin: 8px 0 4px 0; font-weight: bold;">ID Pesanan:</p>
                        <p class="uuid">
                            {{ $item->uuid }}
                        </p>
                    </td>
                @endforeach

                @for($i = count($row); $i < 3; $i++)
                    <td class="qr-item"></td>
                @endfor
            </tr>

            @if(($chunkIndex + 1) % 3 == 0 && !$loop->last)
                <tr>
                    <td colspan="3" class="page-break"></td>
                </tr>
            @endif
        @endforeach
    </table>

    <div class="footer">
        Dibuat pada tanggal {{ now()->format('d/m/Y H:i') }}
    </div>
</body>

</html>