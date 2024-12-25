<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}

// Membaca data dari file
$data_kelas = [];
if (file_exists('data.txt')) {
    $file = fopen('data.txt', 'r');
    while (($line = fgets($file)) !== false) {
        $data = json_decode($line, true);
        if ($data) { // Pastikan data tidak null
            $data_kelas[] = $data;
        }
    }
    fclose($file);
}

// Menangani penambahan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $bulan = $_POST['bulan'];
    $jumlah = $_POST['jumlah'];

    $data = [
        'nama' => $nama,
        'bulan' => $bulan,
        'jumlah' => (int)$jumlah
    ];

    // Menyimpan data ke file
    $file = fopen('data.txt', 'a');
    fwrite($file, json_encode($data) . PHP_EOL);
    fclose($file);

    // Refresh halaman
    header("location: kas.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kas Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>📊 Data Kas Kelas 📊</h2>
        <form method="post" action="">
            <input type="text" name="nama" placeholder="Nama" required>
            <input type="text" name="bulan" placeholder="Bulan" required>
            <input type="number" name="jumlah" placeholder="Jumlah" required>
            <button type="submit">Tambah Data</button>
        </form>
        <ul>
            <?php if (!empty($data_kelas)): ?>
                <?php foreach ($data_kelas as $data): ?>
                    <li>
                        <strong>Nama:</strong> <?php echo htmlspecialchars($data['nama']); ?>, 
                        <strong>Bulan:</strong> <?php echo htmlspecialchars($data['bulan']); ?>, 
                        <strong>Jumlah:</strong> <?php echo number_format($data['jumlah'], 0, ',', '.'); ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Tidak ada data kas kelas yang tersedia.</li>
            <?php endif; ?>
        </ul>
        <a href="logout.php">Logout</a>
    </div>
</body>
</html>