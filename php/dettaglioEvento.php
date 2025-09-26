<?php

require_once("bootstrap.php");

session_start();

if(!isset($_GET["GameID"])){
    header("location: adminInfographics.php");
    exit;
}

$gameID = $_GET["GameID"];

$templateParams["Event"] = $dbh->getEventById($gameID);

if (!$templateParams["Event"]) {
    header("location: adminEvents.php");
    exit;
}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteEvent"])){
    $dbh->deleteEvent($gameID);
    header("Location: adminEvents.php");
    exit;
}

$templateParams["InfographicStats"] = $dbh->getInfographicStatsForEvent($gameID);

//lista delle infografiche solo per modalità fixed
if ($templateParams["Event"]["Mode"] == 'fixed') {
    $templateParams["FixedInfographics"] = $dbh->getFixedInfographicsForEvent($gameID);
}


$templateParams["titolo"] = "Dettaglio Evento";
$templateParams["nome"] = "contenutoDettaglioEvento.php";


require_once("../template/base.php");


?>