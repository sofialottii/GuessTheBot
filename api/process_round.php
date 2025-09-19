<?php

require_once("../php/bootstrap.php");
session_start();
header('Content-Type: application/json');

if (!isset($_SESSION["userID"])) {
    echo json_encode(['success' => false, 'error' => 'Utente non autenticato']);
    exit;
}

$infographicId = (int)$_POST['infographic_id'];
$textShown = $_POST['text_shown']; //human o llm
$userChoice = $_POST['user_choice']; //human o llm
$userID = $_SESSION["userID"];
$explanation = !empty($_POST['explanation']) ? $_POST['explanation'] : null;
$advice = !empty($_POST['consigli']) ? $_POST['consigli'] : null;

$isCorrect = ($textShown === $userChoice) ? 'Y' : 'N';


$dbh->addAnswer($infographicId, $userID, $textShown, $userChoice, $isCorrect, $explanation, $advice);

//se la risposta è corretta aumenta lo score
if ($isCorrect == 'Y') {
    $_SESSION["score"]++;
}

//l'infografica usata viene aggiunta alla lista
if (!in_array($infographicId, $_SESSION["usedInfographics"])) {
    $_SESSION["usedInfographics"][] = $infographicId;
}

$gameFinished = $_SESSION["currentRound"] >= 10;
if (!$gameFinished) {
    $_SESSION["currentRound"]++;
}

//gioco finito: non serve caricare una nuova domanda
if ($gameFinished) {
    echo json_encode([
        'success' => true,
        'gameFinished' => true,
        'score' => $_SESSION['score']
    ]);
    exit;
}


//dati per prossimo round
try {
    $newInfographic = $dbh->getRandomInfographic($_SESSION["usedInfographics"])[0];
    
    if (rand(0, 1) == 0) {
        $text_to_show = $newInfographic['HumanText'];
        $text_type_shown = 'human';
    } else {
        $text_to_show = $newInfographic['LlmText'];
        $text_type_shown = 'llm';
    }
    
    
    echo json_encode([
        'success' => true,
        'gameFinished' => false,
        'nextInfographic' => $newInfographic,
        'nextTextToShow' => $text_to_show,
        'nextTextTypeShown' => $text_type_shown,
        'currentRound' => $_SESSION["currentRound"],
        'score' => $_SESSION["score"]
    ]);

} catch (Exception $e) {
    echo json_encode(['success' => false, 'error' => 'Errore nel caricamento del round: ' . $e->getMessage()]);
}
?>