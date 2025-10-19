// Ambil grandTotal dari element
function getGrandTotal() {
    const grandTotalText = document.getElementById('grandTotal').textContent;
    return parseFloat(grandTotalText.replace(/\./g, '')) || 0;
}

// Hitung kembalian real-time
document.getElementById('payment').addEventListener('input', function () {
    const payment = parseFloat(this.value) || 0;
    const grandTotal = getGrandTotal();
    const change = payment - grandTotal;

    document.getElementById('changeAmount').textContent = change > 0 ? change.toLocaleString('id-ID') : '0';
});

// Payment validation
document.getElementById('btnCetakPesanan').addEventListener('click', function () {
    // Cek apakah ada data di tabel order
    const orderTable = document.querySelector('table tbody');
    const hasOrders = orderTable && orderTable.querySelector('tr') !== null;

    // Cek apakah input quantity sudah diisi
    const quantityInput = document.querySelector('input[name="quantity"]');
    const isQuantityFilled = quantityInput && quantityInput.value.trim() !== '';

    let errorMessage = '';

    if (!hasOrders) {
        errorMessage = 'Belum ada pesanan. Silakan scan item dan masukan jumlah pesanan terlebih dahulu.';
    }

    // Pesan error
    if (errorMessage) {
        showToast(errorMessage, 'error');

        return false; // Hentikan proses
    }

    // Jika validasi sukses, tampilkan modal
    const paymentModal = new bootstrap.Modal(document.getElementById('paymentModal'));
    paymentModal.show();
});

// Fungsi untuk show toast (optional)
function showToast(message, type = 'error') {
    const toastContainer = document.getElementById('toastContainer');
    // Buat container toast jika belum ada
    if (!toastContainer) {
        const container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'toast-container position-fixed top-0 end-0 p-3';
        document.body.appendChild(container);
    }

    const toastId = 'toast-' + Date.now();
    const toastHTML = `
        <div id="${toastId}" class="toast align-items-center text-bg-${type === 'error' ? 'danger' : 'success'} border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">
                    ${message}
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    document.getElementById('toastContainer').innerHTML += toastHTML;

    const toastElement = document.getElementById(toastId);
    const toast = new bootstrap.Toast(toastElement);
    toast.show();

    // Hapus toast dari DOM setelah hide
    toastElement.addEventListener('hidden.bs.toast', function () {
        this.remove();
    });
}

// Process payment
function processPayment() {
    const payment = parseFloat(document.getElementById('payment').value) || 0;
    const grandTotal = getGrandTotal();

    if (payment < grandTotal) {
        alert('Uang pembayaran tidak mencukupi!');
        return;
    }

    document.getElementById('paymentForm').submit();
}