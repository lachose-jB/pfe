<?php
// Configuration de la base de données
$host = '127.0.0.1';
$dbname = 'ELECTRO_PFE_DB';
$user = 'root';
$pass = '';

try {
    // Connexion à la base avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Active les exceptions sur erreur
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); // Mode de fetch par défaut
} catch (PDOException $e) {
    // En cas d'erreur de connexion
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
