<?php
$host = 'localhost';
$dbname = 'martinle_vn_restaurace';
$user = 'martinle'; // Změň podle svého nastavení
$password = 'MikiKun2006'; // Pokud MySQL má heslo, vlož ho sem

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Chyba připojení k databázi: " . $e->getMessage());
}
?>
