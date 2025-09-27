<?php
require_once("../php/bootstrap.php");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION["AdminID"]) || !isset($_POST['gameID'])) {
    echo json_encode(['success' => false, 'error' => 'Accesso non autorizzato o dati mancanti.']);
    exit;
}

$gameID = (int)$_POST['gameID'];
$eventName = $_POST['eventName'];
$expiresAt = $_POST['expiresAt'];

$success = $dbh->updateEventDetails($gameID, $eventName, $expiresAt);

if ($success) {
    echo json_encode([
        'success' => true,
        'updatedName' => htmlspecialchars($eventName),
        'updatedDate' => !empty($expiresAt) ? date("d/m/Y H:i", strtotime($expiresAt)) : 'Nessuna'
    ]);
} else {
    echo json_encode(['success' => false, 'error' => 'Errore durante aggiornamento del database.']);
}
?>