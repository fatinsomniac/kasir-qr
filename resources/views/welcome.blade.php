<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Scanner - RPL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    :root {
      --rpl-blue: #1e40af;
      --rpl-blue-dark: #1e3a8a;
      --rpl-blue-light: #3b82f6;
      --rpl-accent: #60a5fa;
      --rpl-bg: #f0f9ff;
    }

    body {
      background: linear-gradient(135deg, var(--rpl-bg) 0%, #e0f2fe 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .rpl-header {
      background: linear-gradient(120deg, var(--rpl-blue), var(--rpl-blue-dark));
      color: white;
      padding: 1.5rem 0;
      border-radius: 12px 12px 0 0;
      margin: -24px -24px 24px -24px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .scanner-card {
      background: white;
      border-radius: 16px;
      box-shadow: 0 10px 25px rgba(30, 64, 175, 0.15);
      overflow: hidden;
      border: none;
      position: relative;
    }

    .scanner-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, var(--rpl-blue), var(--rpl-blue-light));
    }

    #preview {
      width: 100%;
      height: 300px;
      object-fit: cover;
      background: #000;
      border-radius: 12px;
    }

    .form-control {
      border: 2px solid var(--rpl-blue-light);
      border-radius: 12px;
      padding: 12px 16px;
      font-size: 1.1rem;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--rpl-blue);
      box-shadow: 0 0 0 3px rgba(30, 64, 175, 0.2);
    }

    .btn-primary {
      background: linear-gradient(120deg, var(--rpl-blue), var(--rpl-blue-dark));
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(30, 64, 175, 0.4);
    }

    .btn-danger {
      background: linear-gradient(120deg, #dc2626, #b91c1c);
      border: none;
      padding: 12px 24px;
      border-radius: 12px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-danger:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 15px rgba(220, 38, 38, 0.4);
    }

    .table {
      background: white;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 15px rgba(30, 64, 175, 0.1);
    }

    .table th {
      background: linear-gradient(120deg, var(--rpl-blue), var(--rpl-blue-dark));
      color: white;
      font-weight: 600;
      padding: 16px;
    }

    .table td {
      padding: 16px;
      vertical-align: middle;
    }

    .alert {
      border-radius: 12px;
      border: none;
      padding: 16px 20px;
      margin-bottom: 20px;
      font-weight: 500;
    }

    .alert-success {
      background: linear-gradient(120deg, #10b981, #059669);
      color: white;
    }

    .alert-warning {
      background: linear-gradient(120deg, #f59e0b, #d97706);
      color: white;
    }

    .alert-danger {
      background: linear-gradient(120deg, #ef4444, #dc2626);
      color: white;
    }

    .alert-info {
      background: linear-gradient(120deg, #3b82f6, #2563eb);
      color: white;
    }

    .btn-close {
      filter: invert(1);
    }

    .container {
      max-width: 800px;
    }

    .quantity-input {
      max-width: 200px;
      margin: 0 auto;
    }

    .action-buttons {
      gap: 16px;
      justify-content: center;
    }

    .rpl-logo {
      font-family: 'Courier New', monospace;
      letter-spacing: 1px;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    #nextBtn {
      position: fixed;
      top: 20px;
      right: 20px;
      width: 4rem;
      /* 4x4 ukuran kotak */
      height: 4rem;
      border-radius: 8px;
      z-index: 1000;
      box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
      background-color: #435ebe;
      border: none;
      transition: 0.3s;
    }

    #nextBtn:hover {
      background-color: #3246a3;
      transform: scale(1.05);
    }

    #nextBtn i {
      font-size: 1.5rem;
      color: white;
    }

    @media (max-width: 768px) {
      .rpl-header h2 {
        font-size: 1.8rem;
      }

      #preview {
        height: 250px;
      }

      .action-buttons {
        flex-direction: column;
      }

      .btn {
        width: 100%;
      }
    }
  </style>
</head>

<body>

  <a href="{{ route('items.index') }}"
    id="nextBtn"
    class="btn btn-primary d-flex justify-content-center align-items-center">
    <i class="bi bi-arrow-right"></i>
  </a>

  <div class="container py-5">
    <!-- Title -->
    <div class="rpl-header text-center mb-4">
      <h2 class="rpl-logo">KASIR QR RPL</h2>
      <p class="mb-0" style="opacity: 0.9; font-size: 0.9rem;">Rekayasa Perangkat Lunak - Digital Innovation</p>
    </div>
    <!-- Title -->

    <!-- Scanner -->
    <div class="scanner-card shadow-sm">
      <!-- Alert -->
      @if (session()->has('failed'))
      <div class="alert alert-warning alert-dismissible fade show m-3" role="alert">
        <strong>{{ session()->get('failed') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <!-- Audio -->
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/failed.mp3') }}" type="audio/mp3">
      </audio>
      <button hidden="hidden" onclick="myFunction()">Try it</button>
      <p id="demo"></p>
      <!-- Audio -->
      @endif

      @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        <strong>{{ session()->get('success') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <!-- Audio -->
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/bazzar_rpl.mp3') }}" type="audio/mp3">
      </audio>
      <button hidden="hidden" onclick="myFunction()">Try it</button>
      <p id="demo"></p>
      <!-- Audio -->
      @endif

      @if (session()->has('notNull'))
      <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <strong>{{ session()->get('notNull') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <!-- Audio -->
      <audio id="myAudio" autoplay>
        <source src="{{ asset('sounds/notnull.mp3') }}" type="audio/mp3">
      </audio>
      <button hidden="hidden" onclick="myFunction()">Try it</button>
      <p id="demo"></p>
      <!-- Audio -->
      @endif

      @if (session()->has('reset'))
      <div class="alert alert-info alert-dismissible fade show m-3" role="alert">
        <strong>{{ session()->get('reset') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      @endif
      <!-- Alert -->
      <div class="p-3">
        <video id="preview" class="rounded-3"></video>
      </div>
    </div>
    <!-- Scanner -->

    <div class="form">
      <!-- Form -->
      <form action="{{ route('order.store') }}" method="post" id="form" class="mt-4">
        @csrf
        <input type="hidden" name="id_item" id="id_item">
        <div class="quantity-input mx-auto">
          <input type="text" name="quantity" class="form-control text-center" placeholder="Jumlah Pesanan">
        </div>
      </form>
      <!-- Form -->

      <!-- Button-->
      <div class="d-flex action-buttons mt-3">
        <a href="{{ route('order.reset') }}" class="btn btn-danger">Reset Pesanan</a>
        <a href="{{ route('order.print') }}" class="btn btn-primary">Cetak Pesanan</a>
      </div>
    </div>

    <div class="table-responsive mt-4">
      <table class="table table-bordered">
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
            <td>{{ $index + 1 }}</td>
            <td>{{ $order->item->item_name }}</td>
            <td>{{ $order->quantity }}</td>
            <td>Rp {{ number_format($order->item->price, 0, ',', '.') }}</td>
            <td>Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script type="text/javascript">
    let scanner = new Instascan.Scanner({
      video: document.getElementById('preview')
    });
    scanner.addListener('scan', function(content) {
      console.log(content);
    });
    Instascan.Camera.getCameras().then(function(cameras) {
      if (cameras.length > 0) {
        scanner.start(cameras[0]);
      } else {
        console.error('No cameras found.');
      }
    }).catch(function(e) {
      console.error(e);
    });

    scanner.addListener('scan', function(c) {
      document.getElementById('id_item').value = c;
      document.getElementById('form').submit();
    })

    function myFunction() {
      var x = document.getElementById("myAudio").autoplay;
      document.getElementById("demo").innerHTML = x;
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
</body>

</html>