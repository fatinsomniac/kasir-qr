<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Item</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset("assets/css/items/items.css") }}">
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
  <script src="{{ asset("assets/js/items.js") }}"></script>
</body>

</html>