<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');

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
      --gradient-1: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      --gradient-2: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
      --gradient-3: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
      --glass-bg: rgba(255, 255, 255, 0.9);
      --glass-border: rgba(255, 255, 255, 0.18);
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

    .main-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 2rem;
      position: relative;
      z-index: 1;
    }

    #nextBtn {
      position: fixed;
      top: 24px;
      left: 24px;
      width: 56px;
      height: 56px;
      border-radius: 16px;
      z-index: 1000;
      background: var(--glass-bg);
      backdrop-filter: blur(10px);
      border: 1px solid var(--glass-border);
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
      transform: translateX(-3px);
    }

    .header-section {
      text-align: center;
      margin-bottom: 3rem;
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
      margin-bottom: 0.75rem;
      letter-spacing: -0.02em;
      text-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .header-section .subtitle {
      color: rgba(255, 255, 255, 0.9);
      font-size: 1.125rem;
      font-weight: 400;
      max-width: 600px;
      margin: 0 auto;
    }

    .glass-card {
      background: var(--glass-bg);
      backdrop-filter: blur(20px) saturate(180%);
      border: 1px solid var(--glass-border);
      border-radius: 24px;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      animation: fadeInUp 0.8s ease;
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

    .card-header {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.1) 0%, rgba(139, 92, 246, 0.1) 100%);
      padding: 2rem;
      border-bottom: 1px solid rgba(99, 102, 241, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .card-header h2 {
      font-size: 1.75rem;
      font-weight: 700;
      color: var(--dark);
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin: 0;
    }

    .card-header h2 i {
      font-size: 2rem;
      background: var(--gradient-1);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      background-clip: text;
    }

    .btn-add {
      background: var(--gradient-1);
      color: white;
      border: none;
      padding: 0.875rem 2rem;
      font-weight: 600;
      border-radius: 12px;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 12px rgba(99, 102, 241, 0.3);
      font-size: 0.95rem;
    }

    .btn-add:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.4);
      background: linear-gradient(135deg, #7c7ff5 0%, #8657b8 100%);
    }

    .card-body {
      padding: 2rem;
    }

    .search-section {
      display: grid;
      grid-template-columns: 1fr auto;
      gap: 1rem;
      margin-bottom: 2rem;
    }

    .search-wrapper {
      position: relative;
    }

    .search-wrapper i {
      position: absolute;
      left: 1.25rem;
      top: 50%;
      transform: translateY(-50%);
      color: var(--primary);
      font-size: 1.125rem;
    }

    .search-section .form-control {
      padding: 1rem 1rem 1rem 3.5rem;
      border-radius: 16px;
      border: 2px solid rgba(99, 102, 241, 0.1);
      font-size: 0.95rem;
      transition: all 0.3s ease;
      background: white;
    }

    .search-section .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
      outline: none;
    }

    .btn-download {
      background: var(--gradient-2);
      color: white;
      border: none;
      padding: 1rem 1.75rem;
      border-radius: 16px;
      font-weight: 600;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 4px 12px rgba(245, 87, 108, 0.3);
      white-space: nowrap;
    }

    .btn-download:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(245, 87, 108, 0.4);
      background: linear-gradient(135deg, #f5a7fb 0%, #f76b7c 100%);
    }

    .table-container {
      border-radius: 16px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
    }

    .table {
      margin-bottom: 0;
      background: white;
    }

    .table thead th {
      background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
      font-weight: 700;
      color: var(--dark);
      padding: 1.25rem 1rem;
      border: none;
      text-transform: uppercase;
      font-size: 0.75rem;
      letter-spacing: 0.05em;
    }

    .table tbody td {
      padding: 1.25rem 1rem;
      vertical-align: middle;
      border-bottom: 1px solid #f1f5f9;
      color: var(--dark);
    }

    .table tbody tr {
      transition: all 0.2s ease;
    }

    .table tbody tr:hover {
      background: linear-gradient(135deg, rgba(99, 102, 241, 0.03) 0%, rgba(139, 92, 246, 0.03) 100%);
      transform: scale(1.01);
    }

    .qr-container {
      display: flex;
      justify-content: center;
    }

    .qr-box {
      width: 90px;
      height: 90px;
      border: 2px solid #e2e8f0;
      border-radius: 12px;
      overflow: hidden;
      transition: all 0.3s ease;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .qr-box:hover {
      transform: scale(1.1);
      box-shadow: 0 8px 24px rgba(99, 102, 241, 0.2);
      border-color: var(--primary);
    }

    .qr-box img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .item-name {
      font-weight: 600;
      color: var(--dark);
      font-size: 1rem;
    }

    .price-badge {
      display: inline-block;
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
      color: white;
      padding: 0.5rem 1rem;
      border-radius: 12px;
      font-weight: 700;
      font-size: 1rem;
      box-shadow: 0 2px 8px rgba(16, 185, 129, 0.2);
    }

    .date-cell {
      font-size: 0.875rem;
      color: #64748b;
      font-weight: 500;
    }

    .badge {
      padding: 0.5rem 0.875rem;
      border-radius: 8px;
      font-weight: 600;
      font-size: 0.75rem;
    }

    .action-cell {
      display: flex;
      gap: 0.5rem;
      justify-content: center;
    }

    .btn-action {
      width: 42px;
      height: 42px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      border: none;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      font-size: 1rem;
    }

    .btn-action:hover {
      transform: translateY(-2px);
    }

    .btn-edit {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
      color: white;
      box-shadow: 0 2px 8px rgba(245, 158, 11, 0.3);
    }

    .btn-edit:hover {
      box-shadow: 0 4px 16px rgba(245, 158, 11, 0.4);
    }

    .btn-delete {
      background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
      color: white;
      box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
      box-shadow: 0 4px 16px rgba(239, 68, 68, 0.4);
    }

    .modal-content {
      border-radius: 24px;
      border: none;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      overflow: hidden;
    }

    .modal-header {
      padding: 2rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      position: relative;
    }

    .modal-header.bg-primary {
      background: var(--gradient-1) !important;
    }

    .modal-header.bg-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%) !important;
    }

    .modal-title {
      font-weight: 700;
      font-size: 1.5rem;
    }

    .modal-body {
      padding: 2rem;
    }

    .form-label {
      font-weight: 600;
      color: var(--dark);
      margin-bottom: 0.75rem;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .form-control {
      border-radius: 12px;
      padding: 0.875rem 1rem;
      border: 2px solid #e2e8f0;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: var(--primary);
      box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
      outline: none;
    }

    .btn-submit {
      padding: 1rem 2.5rem;
      border-radius: 12px;
      font-weight: 700;
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      border: none;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-success {
      background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }

    .btn-warning {
      background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }

    .custom-alert {
      position: fixed;
      top: 24px;
      right: -400px;
      min-width: 320px;
      max-width: 400px;
      padding: 1.25rem 1.5rem;
      border-radius: 16px;
      z-index: 9999;
      opacity: 0;
      transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(10px);
      border: 1px solid rgba(255, 255, 255, 0.2);
      font-weight: 600;
    }

    .custom-alert.show {
      right: 24px;
      opacity: 1;
    }

    .custom-alert.hide {
      right: -400px;
      opacity: 0;
    }

    .custom-alert i {
      font-size: 1.25rem;
    }

    @media (max-width: 768px) {
      .main-container {
        padding: 1rem;
      }

      .header-section h1 {
        font-size: 2rem;
      }

      .card-header {
        flex-direction: column;
        align-items: stretch;
      }

      .search-section {
        grid-template-columns: 1fr;
      }

      .table {
        font-size: 0.875rem;
      }

      .qr-box {
        width: 70px;
        height: 70px;
      }
    }

    @media (max-width: 576px) {
      .btn-action {
        width: 36px;
        height: 36px;
      }
    }

    ::-webkit-scrollbar {
      width: 10px;
      height: 10px;
    }

    ::-webkit-scrollbar-track {
      background: #f1f5f9;
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

  {{-- Success Alert --}}
  @if(session('success'))
    <div id="successAlert" class="custom-alert alert alert-success d-flex align-items-center" role="alert">
      <i class="bi bi-check-circle-fill me-2"></i>
      <span>{{ session('success') }}</span>
    </div>
  @endif

  {{-- Error Alert --}}
  @if(session('error'))
    <div id="errorAlert" class="custom-alert alert alert-danger d-flex align-items-center" role="alert">
      <i class="bi bi-exclamation-triangle-fill me-2"></i>
      <span>{{ session('error') }}</span>
    </div>
  @endif

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const alerts = document.querySelectorAll('.custom-alert');

      alerts.forEach(alert => {
        setTimeout(() => {
          alert.classList.add('show');
        }, 100);

        setTimeout(() => {
          alert.classList.remove('show');
          alert.classList.add('hide');
        }, 5100);

        setTimeout(() => {
          alert.remove();
        }, 5600);
      });
    });
  </script>

  <a href="{{ route('order.index') }}" id="nextBtn">
    <i class="bi bi-arrow-left"></i>
  </a>

  <div class="main-container">
    <div class="header-section">
      <h1>📦 Manajemen Item dengan QR Code</h1>
      <p class="subtitle">Kelola inventaris Anda dengan mudah menggunakan kode QR unik dan sistem modern</p>
    </div>

    <div class="glass-card">
      <div class="card-header">
        <h2><i class="bi bi-box-seam"></i> Daftar Item Inventaris</h2>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
          <i class="bi bi-plus-circle me-2"></i> Tambah Item Baru
        </button>
      </div>

      <div class="card-body">
        <div class="search-section">
          <div class="search-wrapper">
            <i class="bi bi-search"></i>
            <input type="text" id="searchInput" class="form-control"
              placeholder="Cari item berdasarkan nama, ID, atau UUID..." onkeyup="searchTable()">
          </div>

          <a href="{{ route('items.download-qr-code') }}" class="btn btn-download">
            <i class="bi bi-file-earmark-pdf-fill me-2"></i> Download semua QR ke PDF
          </a>
        </div>

        <div class="table-container">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>QR Code</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="itemTable">
              @foreach($items as $item)
                <tr>
                  <td><strong>{{ $item->id }}</strong></td>
                  <td>
                    <div class="qr-container">
                      <a href="{{ route('items.qrcode', $item->uuid) }}" class="qr-box">
                        <img src="{{ asset('storage/' . $item->qrcode_path) }}" alt="QR Code">
                      </a>
                    </div>
                  </td>
                  <td><span class="item-name">{{ $item->item_name }}</span></td>
                  <td><span class="price-badge">Rp {{ number_format($item->price, 0, ',', '.') }}</span></td>
                  <td class="date-cell">{{ $item->created_at->format('d M Y, H:i') }}</td>
                  <td class="date-cell">
                    @if($item->updated_at->equalTo($item->created_at))
                      <span class="badge bg-secondary">Belum diperbarui</span>
                    @else
                      {{ $item->updated_at->format('d M Y, H:i') }}
                    @endif
                  </td>
                  <td class="action-cell">
                    <button class="btn btn-edit btn-action" data-bs-toggle="modal" data-bs-target="#editModal"
                      data-id="{{ $item->id }}" data-name="{{ $item->item_name }}" data-price="{{ $item->price }}">
                      <i class="bi bi-pencil-square"></i>
                    </button>
                    <form action="{{ route('items.destroy', $item->id) }}" method="POST"
                      onSubmit="return confirm('Yakin ingin menghapus item ini?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-delete btn-action">
                        <i class="bi bi-trash-fill"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah -->
  <div class="modal fade" id="addModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-primary text-white">
          <h5 class="modal-title"><i class="bi bi-plus-circle me-2"></i> Tambah Item Baru</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="addForm" action="{{ route('items.store') }}" method="POST">
            @csrf

            <div class="mb-4">
              <label class="form-label">Nama Item</label>
              <input type="text" name="item_name" class="form-control" placeholder="Masukkan nama item" required>
            </div>

            <div class="mb-4">
              <label class="form-label">Harga (Rp)</label>
              <input type="number" name="price" class="form-control" placeholder="Masukkan harga" required min="0"
                step="1000">
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-success btn-submit">
                <i class="bi bi-save me-2"></i> Simpan Item
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-warning text-white">
          <h5 class="modal-title"><i class="bi bi-pencil-square me-2"></i> Edit Item</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
              <label class="form-label">Nama Item</label>
              <input type="text" name="item_name" class="form-control" required>
            </div>
            <div class="mb-4">
              <label class="form-label">Harga (Rp)</label>
              <input type="number" name="price" class="form-control" required min="0">
            </div>
            <div class="text-end">
              <button type="submit" class="btn btn-warning btn-submit">
                <i class="bi bi-pencil-square me-2"></i> Perbarui Item
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    function searchTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("#itemTable tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }

    document.addEventListener('DOMContentLoaded', function () {
      const editButtons = document.querySelectorAll('.btn-edit');
      const form = document.getElementById('editForm');
      const nameInput = form.querySelector('input[name="item_name"]');
      const priceInput = form.querySelector('input[name="price"]');

      editButtons.forEach(button => {
        button.addEventListener('click', function () {
          const id = this.dataset.id;
          const name = this.dataset.name;
          const price = this.dataset.price;

          nameInput.value = name;
          priceInput.value = price;
          form.action = `/items/${id}`;
        });
      });
    });
  </script>

</body>

</html>