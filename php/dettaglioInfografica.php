<?php

require_once("bootstrap.php");

session_start();

if(!isset($_GET["IDInfographic"])){
    header("location: adminInfographics.php");
    exit;
}

$idInfographic = $_GET["IDInfographic"];
$idGame = isset($_GET["IDGame"]) ? (int)$_GET["IDGame"] : null;

$templateParams["infografica"] = $dbh->getStatisticsInfographicById($idInfographic, $idGame);
$templateParams["risposte"] = $dbh->getAllAnswersById($idInfographic, $idGame);

$templateParams["eventiFiltro"] = $dbh->getEventsForInfographic($idInfographic); //per il filtro a tendina

$templateParams["filtroAttuale"] = $idGame;
$templateParams["titolo"] = "Dettaglio Infografica";
$templateParams["nome"] = "contenutoDettaglioInfografica.php";


require_once("../template/base.php");


?>