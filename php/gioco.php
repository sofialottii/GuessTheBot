<?php

require_once("bootstrap.php");

session_start();

$activeEvent = $dbh->getActiveEvent();

/**
 * Controllo l'inserimento del nome del giocatore, se non è settato lo rimando alla home.
 * Inizializzo le variabili di sessione per il gioco.
 * Le infografiche già usate vengono salvate in una variabile di sessione per non ripeterle.
 */
if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST["playerName"])) {
    $userID = $dbh->addUser($_POST["playerName"]);

    $_SESSION["playerName"] = $_POST["playerName"];
    $_SESSION["userID"] = $userID;
    $_SESSION["currentRound"] = 1;
    $_SESSION["score"] = 0;
    $_SESSION["usedInfographics"] = []; 
    $_SESSION["currentEvent"] = $activeEvent; //null se non c'è evento attivo

    if (!isset($_SESSION["userID"])){
        header("Location: index.php");
        exit();
    }
    if ($activeEvent && $activeEvent["Mode"] == 'fixed') {
        $fixedInfographics = $dbh->getFixedInfographicsForEvent($activeEvent['GameID']);
        $_SESSION["fixedInfographicsList"] = array_column($fixedInfographics, 'InfographicID');
    }
}

if (isset($_SESSION["currentEvent"]) && $_SESSION["currentEvent"]["Mode"] == 'fixed') {
    //MODALITA FISSA
    $nextInfographicId = $_SESSION["fixedInfographicsList"][$_SESSION["currentRound"] - 1];
    $infographica = $dbh->getInfographicById($nextInfographicId);
} else {
    //RANDOM OPPURE NO EVENTI ATTIVI
    $infographicaArray = $dbh->getRandomInfographic($_SESSION["usedInfographics"]);
    $infographica = $infographicaArray[0];
}

$templateParams["infographic"] = $infographica;

//testo mostrato -> 0 umano, 1 llm
if (rand(0, 1) == 0) {
    $text_to_show = $templateParams["infographic"]['HumanText'];
    $text_type_shown = 'human';
} else {
    $text_to_show = $templateParams["infographic"]['LlmText'];
    $text_type_shown = 'llm';
}

$templateParams["text_to_show"] = $text_to_show;
$templateParams["text_type_shown"] = $text_type_shown;
$templateParams["titolo"] = "Guess The Bot";
$templateParams["nome"] = "contenutoGioco.php";

require_once("../template/base.php");

?>