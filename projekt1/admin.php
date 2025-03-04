<?php
session_start();
include 'db.php';

// Kontrola přihlášení
if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

// Přidání nového jídla
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $allergies = $_POST['allergies'];
    $description = $_POST['description'];

    $stmt = $pdo->prepare("INSERT INTO menu (name, price, allergies, description) VALUES (?, ?, ?, ?)");
    $stmt->execute([$name, $price, $allergies, $description]);

    header('Location: admin.php');
    exit;
}

// Mazání jídla
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $stmt = $pdo->prepare("DELETE FROM menu WHERE id = ?");
    $stmt->execute([$id]);

    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <h1>Administrace Menu</h1>
    <a href="logout.php">Odhlásit se</a>
</header>

    <form method="POST">
        <input type="text" name="name" placeholder="Název jídla" required>
        <input type="number" step="0.01" name="price" placeholder="Cena" required>
        <input type="text" name="allergies" placeholder="Alergeny">
        <textarea name="description" placeholder="Popis"></textarea>
        <button type="submit" name="add">Přidat jídlo</button>
    </form>

    <table>
        <tr><th>Název</th><th>Cena</th><th>Alergeny</th><th>Popis</th><th>Akce</th></tr>
        <?php
        $stmt = $pdo->query("SELECT * FROM menu");
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>
                    <td>{$row['name']}</td>
                    <td>{$row['price']} Kč</td>
                    <td>{$row['allergies']}</td>
                    <td>{$row['description']}</td>
                    <td><a href='admin.php?delete={$row['id']}'>Smazat</a></td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
