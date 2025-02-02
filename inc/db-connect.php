<?php
// für lokale DB mit XAMPP
/*try {
    $pdo = new PDO('mysql:host=localhost;dbname=php-guestbook', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
}
catch(PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...';
    die();
}*/


require_once __DIR__ . '/phptoolconf.php';
try {
    $pdo = new PDO('mysql:host=$host;dbname=$dbname', '$username', '$password', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    echo 'Probleme mit der Datenbankverbindung...' . $e->getMessage();
    die();
}
