let scanner = new Instascan.Scanner({
    video: document.getElementById('preview')
});

scanner.addListener('scan', function (content) {
    console.log(content);
    document.getElementById('id_item').value = content;
    document.getElementById('form').submit();
});

Instascan.Camera.getCameras().then(function (cameras) {
    if (cameras.length > 0) {
        scanner.start(cameras[0]);
    } else {
        console.error('No cameras found.');
        alert('Kamera tidak ditemukan. Pastikan Anda memberikan izin akses kamera.');
    }
}).catch(function (e) {
    console.error(e);
    alert('Error mengakses kamera: ' + e);
});