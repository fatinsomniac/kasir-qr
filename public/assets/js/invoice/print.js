function printStruk() {
    const printContent = document.getElementById('printableArea').innerHTML;
    const originalContent = document.body.innerHTML;
    
    document.body.innerHTML = printContent;
    window.print();
    document.body.innerHTML = originalContent;
    
    // Redirect setelah print
    window.location.href = '/';
}

// Panggil fungsi print ketika halaman loaded
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(printStruk, 1000); // Delay 1 detik
});
