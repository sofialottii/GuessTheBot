<?php
require_once("../php/bootstrap.php");

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION["userID"])) {
    http_response_code(401);
    echo json_encode(['error' => 'Utente non autenticato', 'success' => false]);
    exit;
}

if ($_SESSION["currentRound"] >= 10) {
    echo json_encode(['error' => 'Gioco terminato', 'success' => false]);
    exit;
}

try {
    //qui prendiamo una nuova infografica non ancora usata
    $infographic = $dbh->getRandomInfographic($_SESSION["usedInfographics"])[0];
    
    if (empty($infographic)) {
        throw new Exception("Nessuna infografica disponibile nel database");
    }
    
    if (rand(0, 1) == 0) {
        $text_to_show = $infographic['HumanText'];
        $text_type_shown = 'human';
    } else {
        $text_to_show = $infographic['LlmText'];
        $text_type_shown = 'llm';
    }
    
    $response = [
        'success' => true,
        'infographic' => $infographic,
        'textToShow' => $text_to_show,
        'textTypeShown' => $text_type_shown,
        'currentRound' => $_SESSION["currentRound"],
        'score' => $_SESSION["score"]
    ];
    
    echo json_encode($response);

} catch (Exception $e) {
    echo json_encode([
        'error' => 'Errore nel caricamento del prossimo round: ' . $e->getMessage(),
        'success' => false
    ]);
}
?>