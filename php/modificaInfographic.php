<?php

require_once("bootstrap.php");

session_start();

if(!isset($_GET["IDInfographic"])){
    header("location: adminInfographics.php");
    exit;
}

$idInfographic = $_GET["IDInfographic"];

if(isset($_POST["modifica"])){
    if(isset($_FILES["immagine"]) && $_FILES["immagine"]["error"] == 0){
        //immagine processata esattamente come ho fatto per l'aggiunta
        $target_dir = "../assets/images/";
        $imageFileType = strtolower(pathinfo(basename($_FILES["immagine"]["name"]), PATHINFO_EXTENSION));
        $new_file_name = uniqid('', true) . '.' . $imageFileType;
        $target_file = $target_dir . $new_file_name;
        
        move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file);
        $imagePath = "assets/images/" . $new_file_name;
    } else {
        //se non funziona rimane l'immagine precedente
        $imagePath = $_POST["immagine_esistente"];
    }

    $dbh->updateInfographic($idInfographic, $_POST["nome"], $imagePath, $_POST["humanText"], $_POST["llmText"]);
    
    header("location: dettaglioInfografica.php?IDInfographic=" . $idInfographic);
    exit;
}

if(isset($_POST["cancella"])) {
    $dbh->disableInfographic($idInfographic);
    header("location: adminInfographics.php");
    exit;
}

$templateParams["infografica"] = $dbh->getInfographicById($idInfographic);

$templateParams["titolo"] = "Modifica Infografica";
$templateParams["nome"] = "contenutoModificaInfografica.php";

require_once("../template/base.php");


?>