<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Vietnamská restaurace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Menu - Vietnamská restaurace</h1>
        <nav>
            <a href="login.php">Administrace</a>
        </nav>
    </header>

    <section id="menu">
        <h2>Naše nabídka</h2>
        <table>
            <thead>
                <tr>
                    <th>Název</th>
                    <th>Cena</th>
                    <th>Alergeny</th>
                    <th>Popis</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $stmt = $pdo->query('SELECT * FROM menu');
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>
                            <td>{$row['name']}</td>
                            <td>{$row['price']} Kč</td>
                            <td>{$row['allergies']}</td>
                            <td>{$row['description']}</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </section>
</body>
</html>
