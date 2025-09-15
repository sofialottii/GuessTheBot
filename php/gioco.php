<?php

require_once("bootstrap.php");

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" & isset($_POST["playerName"])) {
    $dbh->addUser($_POST["playerName"]);

    $_SESSION["playerName"] = $_POST["playerName"];
    $_SESSION["userID"] = null;//da aggiungere

    if (!isset($_SESSION["playerName"])){ //da cambiare con userID
        header("Location: index.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}

$infographica = $dbh->getRandomInfograhic();
$templateParams["infographic"] = $infographica[0];

if (rand(0, 1) == 0) {
    $text_to_show = $templateParams["infographic"]['HumanText'];
    $text_type_shown = 'human';
} else {
    $text_to_show = $templateParams["infographic"]['LlmText'];
    $text_type_shown = 'llm';
}

$templateParams["titolo"] = "Guess The Bot";
$templateParams["nome"] = "contenutoGioco.php";

require_once("../template/base.php");

?>