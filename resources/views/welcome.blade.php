<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>QR Scanner - RPL</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href={{ asset("assets/css/home.css") }}>
</head>
<body>

  <a href="{{ route('items.index') }}" id="nextBtn">
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
      <!-- Pesan failed-->
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

      <!-- Pesan success -->
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

      <!-- Item tidak ada -->
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

      <!-- Reset order -->
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
            <input type="number" name="quantity" class="form-control" placeholder="Masukkan Jumlah Pesanan" min="1" default="1"
              step="1">
          </div>        
        </form>

        <div class="action-buttons">
          <a href="{{ route('order.reset') }}" class="btn btn-danger">
            <i class="bi bi-arrow-clockwise"></i>
            Reset Pesanan
          </a>

          <button type="button" class="btn btn-primary" id="btnCetakPesanan">
            <i class="bi bi-printer-fill"></i>
            Cetak Pesanan
          </button>
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

  <!-- Modals -->

  <!-- Modal Input Pembayaran -->
  <div class="modal fade" id="paymentModal" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Masukan Nominal Pembayaran</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="paymentForm" action="{{ route('order.processPayment') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label for="payment" class="form-label">Nominal Pembayaran</label>
              <input type="number" class="form-control" id="payment" name="payment" required min="0">
            </div>
            <div class="mb-3">
              <strong>Total yang harus dibayar: Rp <span id="grandTotal">{{ number_format($grandTotal, 0, ',', '.') }}</span></strong>
            </div>
            <div class="mb-3">
              <strong>Kembalian: Rp <span id="changeAmount">0</span></strong>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
          <button type="button" class="btn btn-primary" onclick="processPayment()">Cetak Struk</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

  <script src="{{ asset('assets/js/qrscanner.js') }}"></script>
  <script src="{{ asset('assets/js/paymentmodal.js') }}"></script>
</body>

</html>