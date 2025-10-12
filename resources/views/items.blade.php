<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manajemen Item dengan QR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    :root {
      --primary-color: #435ebe;
      --primary-hover: #3246a3;
      --secondary-color: #6c757d;
      --success-color: #28a745;
      --warning-color: #ffc107;
      --danger-color: #dc3545;
      --light-bg: #f8f9fa;
      --card-shadow: 0 4px 20px rgba(67, 94, 190, 0.15);
      --border-radius: 12px;
    }

    body {
      background: linear-gradient(135deg, #f5f7ff 0%, #e8ecff 100%);
      min-height: 100vh;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .main-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 2rem;
    }

    .header-section {
      text-align: center;
      margin-bottom: 2rem;
    }

    .header-section h1 {
      color: var(--primary-color);
      font-weight: 700;
      font-size: 2.5rem;
      margin-bottom: 0.5rem;
      text-shadow: 0 2px 4px rgba(67, 94, 190, 0.1);
    }

    .header-section p {
      color: var(--secondary-color);
      font-size: 1.1rem;
      opacity: 0.8;
    }

    .card {
      border: none;
      border-radius: var(--border-radius);
      box-shadow: var(--card-shadow);
      overflow: hidden;
      background: white;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .card:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 30px rgba(67, 94, 190, 0.25);
    }

    .card-header {
      background: linear-gradient(135deg, var(--primary-color) 0%, #5a73d4 100%);
      color: white;
      padding: 1.5rem;
      border-bottom: none;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
    }

    .card-header h2 {
      font-weight: 600;
      font-size: 1.4rem;
      display: flex;
      align-items: center;
      gap: 0.75rem;
      margin: 0;
    }

    .btn-add {
      background: white;
      color: var(--primary-color);
      border: 2px solid white;
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      transition: all 0.2s ease;
    }

    .btn-add:hover {
      background: white;
      color: var(--primary-color);
      border: 2px solid var(--primary-color);
      padding: 0.6rem 1.5rem;
      font-weight: 600;
      scale: 1.08;
    }

    .card-body {
      padding: 1.5rem;
    }

    .search-section {
      display: flex;
      gap: 0.75rem;
      margin-bottom: 1.5rem;
      flex-wrap: wrap;
    }

    .search-section .form-control {
      flex: 1;
      min-width: 250px;
      border-radius: 50px;
      border: 2px solid #e9ecef;
      padding-left: 1.5rem;
      transition: border-color 0.3s ease;
    }

    .search-section .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25);
    }

    .search-section .btn {
      border-radius: 50px;
      padding: 0.6rem 1.2rem;
    }

    .table-container {
      max-height: 500px;
      overflow-y: auto;
      border-radius: 8px;
      overflow-x: auto;
    }

    .table {
      margin-bottom: 0;
      min-width: 800px;
    }

    .table thead th {
      background: linear-gradient(135deg, #f0f4ff 0%, #e6ecff 100%);
      font-weight: 600;
      color: var(--primary-color);
      padding: 1rem;
      border-bottom: 2px solid var(--primary-color);
    }

    .table tbody td {
      padding: 1rem;
      vertical-align: middle;
      border-bottom: 1px solid #f0f4ff;
    }

    .table tbody tr:hover {
      background-color: #f8fafd;
    }

    .qr-box {
      width: 80px;
      height: 80px;
      margin: 0 auto;
      border: 2px solid #e9ecef;
      border-radius: 8px;
      display: flex;
      align-items: center;
      justify-content: center;
      background: white;
    }

    .price-cell {
      font-weight: 700;
      color: var(--success-color);
      font-size: 1.1rem;
    }

    .date-cell {
      font-size: 0.9rem;
      color: var(--secondary-color);
    }

    .action-cell {
      display: flex;
      gap: 0.5rem;
      justify-content: center;
    }

    .btn-action {
      width: 36px;
      height: 36px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 8px;
      padding: 0;
      transition: all 0.2s ease;
    }

    .btn-action:hover {
      transform: scale(1.1);
    }

    .btn-edit {
      background: var(--warning-color);
      color: white;
      border: none;
    }

    .btn-delete {
      background: var(--danger-color);
      color: white;
      border: none;
    }

    .modal-content {
      border-radius: var(--border-radius);
      border: none;
    }

    .modal-header {
      padding: 1.25rem 1.5rem;
      border-bottom: none;
    }

    .modal-body {
      padding: 1.5rem;
    }

    .form-label {
      font-weight: 600;
      color: var(--secondary-color);
      margin-bottom: 0.5rem;
    }

    .form-control {
      border-radius: 8px;
      padding: 0.75rem;
      border: 2px solid #e9ecef;
    }

    .form-control:focus {
      border-color: var(--primary-color);
      box-shadow: 0 0 0 0.2rem rgba(67, 94, 190, 0.25);
    }

    .btn-submit {
      padding: 0.75rem 2rem;
      border-radius: 8px;
      font-weight: 600;
      transition: all 0.3s ease;
    }

    .btn-submit:hover {
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    /* Scrollbar styling */
    .table-container::-webkit-scrollbar {
      width: 8px;
    }

    .table-container::-webkit-scrollbar-track {
      background: #f1f3f9;
      border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb {
      background: var(--primary-color);
      border-radius: 4px;
    }

    .table-container::-webkit-scrollbar-thumb:hover {
      background: var(--primary-hover);
    }

    #nextBtn {
      position: fixed;
      top: 20px;
      left: 20px;
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

    /* Responsive adjustments */
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
        flex-direction: column;
      }

      .search-section .form-control {
        min-width: auto;
      }

      .table {
        min-width: 600px;
      }
    }

    @media (max-width: 576px) {
      .action-cell {
        gap: 0.25rem;
      }

      .btn-action {
        width: 32px;
        height: 32px;
      }

      .qr-box {
        width: 60px;
        height: 60px;
      }
    }
  </style>
</head>

<body>

  <a href="{{ route('order.index') }}" id="nextBtn"
    class="btn btn-primary d-flex justify-content-center align-items-center">
    <i class="bi bi-arrow-left"></i>
  </a>

  <div class="main-container">
    <div class="header-section">
      <h1>📦 Manajemen Item dengan QR Code</h1>
      <p>Kelola inventaris Anda dengan mudah menggunakan kode QR unik</p>
    </div>

    <div class="card">
      <div class="card-header">
        <h2><i class="bi bi-box-seam"></i> Daftar Item Inventaris</h2>
        <button class="btn btn-add" data-bs-toggle="modal" data-bs-target="#addModal">
          <i class="bi bi-plus-circle me-2"></i> Tambah Item Baru
        </button>
      </div>

      <div class="card-body">
        <!-- Search Bar -->
        <div class="search-section">
          <input type="text" id="searchInput" class="form-control shadow-sm"
            placeholder="Cari item berdasarkan nama, ID, atau UUID..." onkeyup="searchTable()">
          <button class="btn btn-outline-danger" onclick="resetSearch()">
            <i class="bi bi-x-circle me-1"></i> Reset
          </button>
        </div>

        <!-- Table -->
        <div class="table-container">
          <table class="table table-hover align-middle">
            <thead>
              <tr>
                <th>ID</th>
                <th>UUID</th>
                <th>QR Code</th>
                <th>Nama Item</th>
                <th>Harga</th>
                <th>Dibuat</th>
                <th>Diperbarui</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody id="itemTable">
              <!-- <tr>
                <td>1</td>
                <td>a4f70d2e-a573-45b4-92b6-b6e27bb7a7f1</td>
                <td>
                  <div id="qr-1" class="qr-box mx-auto"></div>
                </td>
                <td>Seblak</td>
                <td class="price-cell">Rp 5.000</td>
                <td class="date-cell">2025-10-07</td>
                <td class="date-cell">2025-10-07</td>
                <td class="action-cell">
                  <button class="btn btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-action btn-delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td>a4f70d2e-a573-45b4-92b6-b6e27bb7a7f2</td>
                <td>
                  <div id="qr-2" class="qr-box mx-auto"></div>
                </td>
                <td>Rujak Kangkung</td>
                <td class="price-cell">Rp 5.000</td>
                <td class="date-cell">2025-10-07</td>
                <td class="date-cell">2025-10-07</td>
                <td class="action-cell">
                  <button class="btn btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-action btn-delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td>a4f70d2e-a573-45b4-92b6-b6e27bb7a7f3</td>
                <td>
                  <div id="qr-3" class="qr-box mx-auto"></div>
                </td> 
                <td>Es Jeruk</td>
                <td class="price-cell">Rp 5.000</td>
                <td class="date-cell">2025-10-07</td>
                <td class="date-cell">2025-10-07</td>
                <td class="action-cell">
                  <button class="btn btn-action btn-edit" data-bs-toggle="modal" data-bs-target="#editModal">
                    <i class="bi bi-pencil"></i>
                  </button>
                  <button class="btn btn-action btn-delete">
                    <i class="bi bi-trash"></i>
                  </button>
                </td>
              </tr> -->
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

            <div class="mb-3">
              <label class="form-label">Nama Item</label>
              <input type="text" name="item_name" class="form-control" placeholder="Masukkan nama item" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Harga (Rp)</label>
              <input type="number" name="price" class="form-control" placeholder="Masukkan harga" required min="0">
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
          <form id="editForm">
            <div class="mb-3">
              <label class="form-label">Nama Item</label>
              <input type="text" class="form-control" value="Seblak" required>
            </div>
            <div class="mb-3">
              <label class="form-label">Harga (Rp)</label>
              <input type="number" class="form-control" value="5000" required min="0">
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
  <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>

  <script>
    // Generate QR Codes dari UUID
    const data = [{
      id: 1,
      uuid: "a4f70d2e-a573-45b4-92b6-b6e27bb7a7f1"
    },
    {
      id: 2,
      uuid: "a4f70d2e-a573-45b4-92b6-b6e27bb7a7f2"
    },
    {
      id: 3,
      uuid: "a4f70d2e-a573-45b4-92b6-b6e27bb7a7f3"
    }
    ];

    data.forEach(item => {
      new QRCode(document.getElementById("qr-" + item.id), {
        text: item.uuid,
        width: 70,
        height: 70,
        colorDark: "#435ebe",
        colorLight: "#ffffff"
      });
    });

    // Fungsi pencarian tabel
    function searchTable() {
      let input = document.getElementById("searchInput").value.toLowerCase();
      let rows = document.querySelectorAll("#itemTable tr");
      rows.forEach(row => {
        let text = row.innerText.toLowerCase();
        row.style.display = text.includes(input) ? "" : "none";
      });
    }

    function resetSearch() {
      document.getElementById("searchInput").value = "";
      searchTable();
    }
  </script>

</body>

</html>