<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>QR Code - {{ $item->item_name }}</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 0; 
            padding: 20px; 
            color: #333;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #ddd;
            padding-bottom: 20px;
        }
        .header h1 {
            color: #2c3e50;
            margin: 0 0 10px 0;
        }
        .header p {
            margin: 5px 0;
            color: #7f8c8d;
        }
        
        /* QR Container - Sama seperti di multiple QR */
        .qr-table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }
        .qr-item {
            width: 33.33%;
            text-align: center;
            padding: 20px 10px;
            border: 1px solid #ecf0f1;
            page-break-inside: avoid;
            vertical-align: middle;
            height: 200px;
        }
        
        .uuid {
            font-family: monospace;
            font-size: 10px;
            word-break: break-all;
            margin: 5px 0 0 0;
            line-height: 1.2;
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
        <h1>QR Code {{ $item -> item_name }}</h1>
    </div>

    <table class="qr-table">
        <tr>
            <!-- Item -->
            <td class="qr-item">
                <img src="{{ storage_path('app/public/' . $item->qrcode_path) }}" 
                     width="100" height="100" alt="QR Code"
                     style="display: block; margin: 0 auto 10px auto;">

                <p style="margin: 8px 0 4px 0; font-weight: bold;">ID Pesanan:</p>
                <p class="uuid">{{ $item->uuid }}</p>
                
                {{-- Tambah info item name dan price --}}
                <p style="margin: 15px 0 4px 0; font-weight: bold; font-size: 14px;">{{ $item->item_name }}</p>
                <p style="margin: 0 0 10px 0;">
                    Rp {{ number_format($item->price, 0, ',', '.') }}
                </p>
            </td>
        </tr>
    </table>

    <div class="footer">
        Dibuat pada tanggal {{ now()->format('d/m/Y H:i') }}
    </div>
</body>
</html>