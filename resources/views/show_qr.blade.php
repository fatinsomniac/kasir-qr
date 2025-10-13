<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak QR Code - {{ $item->item_name }}</title>

  <!-- Bootstrap & Icon -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background: #fff;
      font-family: "Arial", sans-serif;
      color: #000;
    }

    .qr-container {
      max-width: 500px;
      margin: 80px auto;
      text-align: center;
      border: 1px solid #ccc;
      padding: 30px;
      border-radius: 10px;
    }

    img.qr-code {
      border: 2px solid #000;
      border-radius: 10px;
      width: 280px;
      height: 280px;
      object-fit: cover;
    }

    h4 {
      font-weight: bold;
      margin-bottom: 20px;
    }

    @media print {
      button, .no-print {
        display: none !important;
      }

      body {
        background: #fff !important;
      }

      .qr-container {
        border: none;
        box-shadow: none;
      }
    }
  </style>
</head>

<body>
  <div class="qr-container">
    <h4>{{ $item->item_name }}</h4>

    <img src="{{ asset('storage/' . $item->qrcode_path) }}"
         alt="QR Code"
         class="qr-code mb-3">

    <p class="mb-1"><strong>Kode UUID:</strong></p>
    <p style="font-family: monospace;">{{ $item->uuid }}</p>

    <div class="no-print mt-4">
      <button class="btn btn-secondary" onclick="window.history.back();">
        <i class="bi bi-arrow-left"></i> Kembali
      </button>
      <button class="btn btn-primary" onclick="window.print();">
        <i class="bi bi-printer"></i> Cetak
      </button>
    </div>
  </div>
</body>
</html>
