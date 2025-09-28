<?php
require_once("bootstrap.php");
session_start();


//esportare tutti i dati o solo quelli di un utente
$userIdToExport = isset($_GET['userID']) ? (int)$_GET['userID'] : null;


$filename = "risultati_";
$filename .= ($userIdToExport) ? "user_" . $userIdToExport : "generale";
$filename .= "_" . date('Y-m-d') . ".csv";


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');


$output = fopen('php://output', 'w');


fputcsv($output, ['ID Risposta', 'Giocatore', 'Evento', 'Infografica', 'Testo Mostrato', 'Scelta Utente', 'Corretta', 'Motivazione', 'Consiglio', 'Data']);


$result = ($userIdToExport) ? $dbh->getUserAnswersForExport($userIdToExport) : $dbh->getAllAnswersForExport();

//scrivo ogni riga del risultato nel file CSV
if ($result) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
exit();
?>