<?php
require_once("../php/bootstrap.php");

header('Content-Type: application/json');
session_start();

if (!isset($_SESSION["userID"])) {
    http_response_code(401);
    echo json_encode(['error' => 'Utente non autenticato']);
    exit;
}

if (!isset($_POST['infographic_id'], $_POST['text_shown'], $_POST['user_choice'])) {
    http_response_code(400);
    echo json_encode(['error' => 'Dati mancanti']);
    exit;
}

$infographicId = (int)$_POST['infographic_id'];
$textShown = $_POST['text_shown']; //human o llm
$userChoice = $_POST['user_choice']; //human o llm
$userID = $_SESSION["userID"];

//controllo se la risposta è corretta
$isCorrect = ($textShown === $userChoice) ? 'Y' : 'N';

//risposta salvata nel db
$dbh->addAnswer($infographicId, $userID, $textShown, $userChoice, $isCorrect, null);

//aggiornato punteggio e round nella sessione
if ($isCorrect === 'Y') {
    $_SESSION["score"]++;
}
$_SESSION["currentRound"]++;

//l'infografica usata viene aggiunta alla lista
if (!in_array($infographicId, $_SESSION["usedInfographics"])) {
    $_SESSION["usedInfographics"][] = $infographicId;
}

$gameFinished = $_SESSION["currentRound"] >= 10;

$response = [
    'isCorrect' => $isCorrect === 'Y',
    'score' => $_SESSION["score"],
    'currentRound' => $_SESSION["currentRound"],
    'gameFinished' => $gameFinished
];

echo json_encode($response);
?>