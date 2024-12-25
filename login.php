<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Ubah username dan password di sini
    if ($username == 'kelasB' && $password == 'buakar') {
        $_SESSION['loggedin'] = true;
        header("location: kas.php");
        exit;
    } else {
        $error = "😢 Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Kas Kelas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <h2>🐻 Masuk ke Aplikasi Kas Kelas 🐻</h2>
        <form method="post" action="">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">🎈 Masuk</button>
        </form>
        <?php if (isset($error)) { echo "<div class='error'>$error</div>"; } ?>
    </div>
</body>
</html>