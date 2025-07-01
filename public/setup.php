<?php
// setup.php - Otomatis dijalankan saat diakses
// Cek dan buat database SQLite jika belum ada, lalu log statusnya

// Path ke database SQLite (harus sesuai dengan konfigurasi project)
$dbPath = __DIR__ . '/../writable/sea_catering.db';
$logPath = __DIR__ . '/../writable/setup.log';

header('Content-Type: text/html; charset=utf-8');

echo '<h2>Setup Database SEA Catering</h2>';

if (file_exists($dbPath)) {
    echo '<p style="color:green;">Database sudah tersedia: <b>' . htmlspecialchars($dbPath) . '</b></p>';
    exit;
}

try {
    // Buat database SQLite baru (file kosong)
    $db = new SQLite3($dbPath);
    $db->close();
    $logMsg = date('Y-m-d H:i:s') . " - Database baru berhasil dibuat di $dbPath\n";
    file_put_contents($logPath, $logMsg, FILE_APPEND);
    echo '<p style="color:blue;">Database baru berhasil dibuat: <b>' . htmlspecialchars($dbPath) . '</b></p>';
    echo '<p style="color:orange;">Silakan jalankan <b>php spark migrate</b> secara manual untuk membuat struktur tabel.</p>';
    echo '<pre>Log: ' . htmlspecialchars($logMsg) . '</pre>';
} catch (Exception $e) {
    $logMsg = date('Y-m-d H:i:s') . " - Gagal membuat database: " . $e->getMessage() . "\n";
    file_put_contents($logPath, $logMsg, FILE_APPEND);
    echo '<p style="color:red;">Gagal membuat database: ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<pre>Log: ' . htmlspecialchars($logMsg) . '</pre>';
} 