<?php

require_once("bootstrap.php");

session_start();

$templateParams["titolo"] = "Aggiungi Infografica";
$templateParams["nome"] = "contenutoAggiungiInfografica.php";

if(isset($_POST["aggiungi"])){
    $img = "../assets/images/".$_FILES["immagine"]["name"];
    $dbh->addInfographic($_POST["nome"], $img, $_POST["humanText"], $_POST["llmText"]);
    header("location: adminInfographics.php");
    exit;
}

require_once("../template/base.php");


?>