<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kas Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>🎉 Selamat Datang di Aplikasi Kas Kelas! 🎉</h1>
        <a href="kas.php" class="button">💰 Kelola Kas Kelas</a>
        <a href="logout.php" class="button">🚪 Logout</a>
    </div>
</body>
</html>