<?php

require_once("bootstrap.php");

session_start();

if(!isset($_GET["IDInfographic"])){
    header("location: adminInfographics.php");
    exit;
}

$idInfographic = $_GET["IDInfographic"];

$templateParams["infografica"] = $dbh->getStatisticsInfographicById($idInfographic);
$templateParams["risposte"] = $dbh->getAllAnswersById($idInfographic);


$templateParams["titolo"] = "Dettaglio Infografica";
$templateParams["nome"] = "contenutoDettaglioInfografica.php";


require_once("../template/base.php");


?>