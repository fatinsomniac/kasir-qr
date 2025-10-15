<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Scanner - RPL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

  <style>
    :root {
      --primary: #6366f1;
      --primary-dark: #4f46e5;
      --primary-light: #818cf8;
      --secondary: #8b5cf6;
      --accent: #ec4899;
      --success: #10b981;
      --warning: #f59e0b;
      --danger: #ef4444;
      --dark: #1e293b;
      --light: #f8fafc;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Plus Jakarta Sans', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
    }

    body::before {
      content: '';
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background:
        radial-gradient(circle at 20% 50%, rgba(99, 102, 241, 0.2) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(236, 72, 153, 0.2) 0%, transparent 50%);
      pointer-events: none;
      z-index: 0;
    }

    .container {
      max-width: 900px;
      position: relative;
      z-index: 1;
    }

    #nextBtn {
      position: fixed;
      top: 24px;
      right: 24px;
      width: 56px;
      height: 56px;
      border-radius: 16px;
      z-index: 1000;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.18);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      display: flex;
      align-items: center;
      justify-content: center;
    }

    #nextBtn:hover {
      transform: translateY(-2px) scale(1.05);
      box-shadow: 0 12px 48px rgba(99, 102, 241, 0.3);
      background: white;
    }

    #nextBtn i {
      font-size: 1.5rem;
      color: var(--primary);
      transition: transform 0.3s ease;
    }

    #nextBtn:hover i {
      transform: translateX(3px);
    }

    .header-section {
      text-align: center;
      margin-bottom: 2rem;
      padding: 3rem 2rem;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      border: 1px solid rgba(255, 255, 255, 0.2);
      animation: fadeInDown 0.8s ease;
    }

    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .header-section h1 {
      font-size: 3rem;
      font-weight: 800;
      background: linear-gradient(135deg, #ffffff 0%, #f0f0f0 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
      margin-bottom: 0.5rem;
      letter-spacing: 2px;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header-section p {
      color: rgba(255, 255, 255, 0.9);
      font-size: 1rem;
      font-weight: 500;
    }

    .scanner-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.3);
      animation: fadeInUp 0.8s ease;
      position: relative;
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(30px);
      }

      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .scanner-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 6px;
      background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
      background-size: 200% 100%;
      animation: gradientShift 3s ease infinite;
    }

    @keyframes gradientShift {

      0%,
      100% {
        background-position: 0% 50%;
      }

      50% {
        background-position: 100% 50%;
      }
    }

    .scanner-wrapper {
      position: relative;
      padding: 2rem;
    }

    #preview {
      width: 100%;
      height: 400px;
      object-fit: cover;
      background: #000;
      border-radius: 20px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
      position: relative;
    }

    .scanner-overlay {
      position: absolute;
      top: 2rem;
      left: 2rem;
      right: 2rem;
      bottom: 2rem;
      border: 3px solid var(--primary-light);
      border-radius: 20px;
      pointer-events: none;
      animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {

      0%,
      100% {
        opacity: 0.5;
      }

      50% {
        opacity: 1;
      }
    }

    .scanner-corners {
      position: absolute;
      top: 2rem;
      left: 2rem;
      right: 2rem;
      bottom: 2rem;
      pointer-events: none;
    }

    .corner {
      position: absolute;
      width: 40px;
      height: 40px;
      border: 4px solid var(--primary);
    }

    .corner.top-left {
      top: 0;
      left: 0;
      border-right: none;
      border-bottom: none;
      border-radius: 20px 0 0 0;
    }

    .corner.top-right {
      top: 0;
      right: 0;
      border-left: none;
      border-bottom: none;
      border-radius: 0 20px 0 0;
    }

    .corner.bottom-left {
      bottom: 0;
      left: 0;
      border-right: none;
      border-top: none;
      border-radius: 0 0 0 20px;
    }

    .corner.bottom-right {
      bottom: 0;
      right: 0;
      border-left: none;
      border-top: none;
      border-radius: 0 0 20px 0;
    }

    .scanner-status {
      position: absolute;
      bottom: 3rem;
      left: 50%;
      transform: translateX(-50%);
      background: rgba(99, 102, 241, 0.9);
      backdrop-filter: blur(10px);
      padding: 0.75rem 1.5rem;
      border-radius: 12px;
      color: white;
      font-weight: 600;
      font-size: 0.9rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .form-section {
      padding: 2rem;
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
      border-radius: 0 0 24px 24px;
    }

    .form-control {
      border: 2px solid rgba(99, 102, 241, 0.2);
      border-radius: 16px;
      padding: 1rem 1.5rem;
      font-size: 1.125rem;
      font-weight: 600;
      text-align: center;
      transition: all 0.3s ease;
      background: white;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
      outline: none;
    }

    .form-control::placeholder {
      color: #94a3b8;
      font-weight: 500;
    }

    .action-buttons {
      display: flex;
      gap: 1rem;
      margin-top: 1.5rem;
    }

    .btn {
      flex: 1;
      padding: 1rem 2rem;
      border-radius: 16px;
      font-weight: 700;
      border: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 1rem;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
    }

    .btn-danger {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(239, 68, 68, 0.4);
    }

    .btn-primary {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
    }

    .alert {
      border-radius: 16px;
      border: none;
      padding: 1.25rem 1.5rem;
      margin: 1.5rem;
      font-weight: 600;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      animation: slideIn 0.5s ease;
      backdrop-filter: blur(10px);
    }

    @keyframes slideIn {
      from {
        opacity: 0;
        transform: translateX(20px);
      }

      to {
        opacity: 1;
        transform: translateX(0);
      }
    }

    .alert i {
      font-size: 1.5rem;
    }

    .alert-success {
      background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
    }

    .alert-warning {
      background: linear-gradient(135deg, rgba(245, 158, 11, 0.95) 0%, rgba(217, 119, 6, 0.95) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .alert-danger {
      background: linear-gradient(135deg, rgba(239, 68, 68, 0.95) 0%, rgba(220, 38, 38, 0.95) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .alert-info {
      background: linear-gradient(135deg, rgba(59, 130, 246, 0.95) 0%, rgba(37, 99, 235, 0.95) 100%);
      color: white;
      box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-close {
      filter: brightness(0) invert(1);
      opacity: 0.8;
    }

    .table-card {
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      border-radius: 24px;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
      overflow: hidden;
      border: 1px solid rgba(255, 255, 255, 0.3);
      margin-top: 2rem;
      animation: fadeInUp 0.8s ease 0.2s both;
    }

    .table {
      margin-bottom: 0;
    }

    .table thead th {
      background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
      color: white;
      font-weight: 700;
      padding: 1.25rem 1rem;
      border: none;
      text-transform: uppercase;
      font-size: 0.875rem;
      letter-spacing: 0.5px;
    }

    .table tbody td {
      padding: 1.25rem 1rem;
      vertical-align: middle;
      border-bottom: 1px solid rgba(99, 102, 241, 0.1);
      color: var(--dark);
      font-weight: 500;
    }

    .table tbody tr {
      transition: all 0.2s ease;
    }

    .table tbody tr:hover {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.05) 0%, rgba(139, 92, 246, 0.05) 100%);
    }

    .table tbody tr:last-child td {
      border-bottom: none;
    }

    .quantity-badge {
      display: inline-block;
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      color: white;
      padding: 0.375rem 0.875rem;
      border-radius: 12px;
      font-weight: 700;
      font-size: 0.875rem;
    }

    @media (max-width: 768px) {
      .header-section h1 {
        font-size: 2rem;
      }

      #preview {
        height: 300px;
      }

      .action-buttons {
        flex-direction: column;
      }

      .scanner-wrapper {
        padding: 1rem;
      }

      .form-section {
        padding: 1.5rem;
      }

      .table {
        font-size: 0.875rem;
      }

      .table thead th,
      .table tbody td {
        padding: 0.875rem 0.5rem;
      }
    }

    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    ::-webkit-scrollbar-track {
      background: rgba(241, 245, 249, 0.5);
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb {
      background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
      border-radius: 5px;
    }

    ::-webkit-scrollbar-thumb:hover {
      background: linear-gradient(135deg, var(--primary-dark) 0%, var(--secondary) 100%);
    }
  </style>
</head>

<body>

  <a href="{{ route('items.index') }}"
    id="nextBtn">
    <i class="bi bi-arrow-right"></i>
  </a>

  <div class="container py-5">
    <!-- Header -->
    <div class="header-section">
      <h1>🎯 KASIR QR RPL</h1>
      <p>Rekayasa Perangkat Lunak - Digital Innovation</p>
    </div>

    <!-- Scanner Card -->
    <div class="scanner-card">
      <!-- Alerts -->
      @if (session()->has('failed'))
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <span>{{ session()->get('failed') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/failed.mp3') }}" type="audio/mp3">
      </audio>
      @endif

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session()->get('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/bazzar_rpl.mp3') }}" type="audio/mp3">
      </audio>
      @endif

      @if (session()->has('notNull'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-x-circle-fill"></i>
        <span>{{ session()->get('notNull') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/notnull.mp3') }}" type="audio/mp3">
      </audio>
      @endif

      @if (session()->has('reset'))
      <div class="alert alert-info alert-dismissible fade show" role="alert">
        <i class="bi bi-arrow-clockwise"></i>
        <span>{{ session()->get('reset') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
      @endif

      <!-- Scanner -->
      <div class="scanner-wrapper">
        <video id="preview"></video>
        <div class="scanner-overlay"></div>
        <div class="scanner-corners">
          <div class="corner top-left"></div>
          <div class="corner top-right"></div>
          <div class="corner bottom-left"></div>
          <div class="corner bottom-right"></div>
        </div>
        <div class="scanner-status">
          <i class="bi bi-qr-code-scan me-2"></i>
          Arahkan QR Code ke kamera
        </div>
      </div>

      <!-- Form Section -->
      <div class="form-section">
        <form action="{{ route('order.store') }}" method="post" id="form">
          @csrf
          <input type="hidden" name="id_item" id="id_item">

          <div class="quantity-input mb-3">
            <input type="number" name="quantity" class="form-control" placeholder="Masukkan Jumlah Pesanan" min="1" step="1">
          </div>

          <div class="payment-input mb-3">
            <input type="number" name="payment" class="form-control" placeholder="Masukkan Nominal Pembayaran" min="0" step="1000">
          </div>
        </form>

        <div class="action-buttons">
          <a href="{{ route('order.reset') }}" class="btn btn-danger">
            <i class="bi bi-arrow-clockwise"></i>
            Reset Pesanan
          </a>
          <a href="{{ route('order.print') }}" class="btn btn-primary">
            <i class="bi bi-printer-fill"></i>
            Cetak Pesanan
          </a>
        </div>
      </div>
    </div>

    <!-- Order Table -->
    @if(isset($orders) && count($orders) > 0)
    <div class="table-card">
      <div class="table-responsive">
        <table class="table">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Item</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($orders as $index => $order)
            <tr>
              <td><strong>{{ $index + 1 }}</strong></td>
              <td>{{ $order->item->item_name }}</td>
              <td><span class="quantity-badge">{{ $order->quantity }}</span></td>
              <td>Rp {{ number_format($order->item->price, 0, ',', '.') }}</td>
              <td><strong>Rp {{ number_format($order->total_price, 0, ',', '.') }}</strong></td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    @endif
  </div>

  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script type="text/javascript">
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview')
    });

    scanner.addListener('scan', function(content) {
      console.log(content);
      document.getElementById('id_item').value = content;
      document.getElementById('form').submit();
    });

    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
        alert('Kamera tidak ditemukan. Pastikan Anda memberikan izin akses kamera.');
      }
    }).catch(function(e) {
      console.error(e);
      alert('Error mengakses kamera: ' + e);
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>