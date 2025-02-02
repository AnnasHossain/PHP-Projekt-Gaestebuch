<?php

require_once __DIR__ . '/inc/db-connect.php';
require_once __DIR__ . '/inc/functions.php';

$perPage = 3;
/*$currentPage = 1;
if(isset($_GET['page'])):
    $currentPage = @(int) $_GET['page']; // mit klammer und datentyp überschreibe ich den Datentyp
    if($currentPage <= 0): $currentPage = 1; endif;
endif;*/


/*  Code kompakter geschrieben */
// Klammer wichtig damit ?? zuerst ausgeführt wird
// ascendo-schreibweise für if-verzweigung (ISt GET gesetzt? JA? --> übernehmen, Nein? --> als 1 einsetzen
 // Warnungen ignorieren und Ausgabe in INT umwandeln
$currentPage = @(int) ($_GET['page'] ?? 1);
if ($currentPage <= 0) {
    $currentPage = 1;
}


//zum testen
//var_dump($currentPage);
//die();

$stmtCount = $pdo->prepare('SELECT COUNT(*) AS `count` FROM `entries`');
$stmtCount->execute();
$countTotal = $stmtCount->fetch(PDO::FETCH_ASSOC)['count'];



$stmt = $pdo->prepare('SELECT * FROM `entries` ORDER BY `id` DESC LIMIT :offset, :perPage' ); //Platzhalter am Ende setzten für Schutz
$stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
$stmt->bindValue(':offset', ($currentPage-1)*$perPage, PDO::PARAM_INT  );
// wenn wir auf Seite 1 sind --> offSet auf 0
// wenn auf Seite 2 dann --> offset sollte $perPage  sein
// wenn auf Seite 3 dann --> offset sollte $perPage *2 sein also 4
$stmt->execute();
$entries = $stmt->fetchAll(PDO::FETCH_ASSOC);
//echo "i work here "; // working soo good, wants to crashing my mac
require __DIR__ . '/views/index.view.php';