<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ? AND password = ?");
    $stmt->execute([$username, $password]);

    if ($stmt->rowCount() > 0) {
        $_SESSION['admin'] = $username;
        header('Location: admin.php');
        exit;
    } else {
        $error = "Špatné přihlašovací údaje.";
    }
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="login-container">
        <a href="index.php" class="back-button">← Zpět na hlavní stránku</a>
        <h2>Přihlášení</h2>
        <form method="POST">
            <input type="text" name="username" placeholder="Uživatelské jméno" required>
            <input type="password" name="password" placeholder="Heslo" required>
            <button type="submit">Přihlásit se</button>
        </form>
        <?php if (isset($error)) echo "<p class='error'>$error</p>"; ?>
    </div>
</body>
</html>
