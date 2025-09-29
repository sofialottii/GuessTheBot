<?php
require_once("../php/bootstrap.php");
session_start();


//esportare tutti i dati o solo quelli di un utente
$userIdToExport = isset($_GET['userID']) ? $_GET['userID'] : null;
$sessionIdToExport = isset($_GET['IDGame']) && $_GET["IDGame"] > 0 ? $_GET['IDGame'] : null;


$filename = "risultati_";
$filename .= ($sessionIdToExport) ? "sessione_" . $sessionIdToExport : "";
$filename .= ($userIdToExport) ? "user_" . $userIdToExport : "generale";
$filename .= "_" . date('Y-m-d') . ".csv";


header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename="' . $filename . '"');


$output = fopen('php://output', 'w');


fputcsv($output, ['ID Utente', 'Giocatore', 'Evento', 'Infografica', 'Testo Mostrato', 'Scelta Utente', 'Corretta', 'Motivazione', 'Consiglio', 'Data']);


//$result = ($userIdToExport) ? $dbh->getUserAnswersForExport($userIdToExport) : $dbh->getAllAnswersForExport();

$result = null;
if ($userIdToExport){
    $result = ($sessionIdToExport) ? $dbh->getSessionAnswersForExport($sessionIdToExport, $sessionIdToExport) : $dbh->getUserAnswersForExport($userIdToExport);
} else {
    $result = ($sessionIdToExport) ? $dbh->getSessionAnswersForExport($sessionIdToExport) : $dbh->getAllAnswersForExport();
}


//scrivo ogni riga del risultato nel file CSV
if ($result) {
    while ($row = $result->fetch_assoc()) {
        fputcsv($output, $row);
    }
}

fclose($output);
exit();
?>