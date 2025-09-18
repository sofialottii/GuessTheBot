<?php

require_once("bootstrap.php");

session_start();

$templateParams["titolo"] = "Aggiungi Infografica";
$templateParams["nome"] = "contenutoAggiungiInfografica.php";

if(isset($_POST["aggiungi"])){
    $target_dir = "../assets/images/";
    $image_original_name = basename($_FILES["immagine"]["name"]);
    $imageFileType = strtolower(pathinfo($image_original_name, PATHINFO_EXTENSION));

    $new_file_name = uniqid('', true) . '.' . $imageFileType;
    $target_file = $target_dir . $new_file_name;

    if (move_uploaded_file($_FILES["immagine"]["tmp_name"], $target_file)) {
            
            $img_path_for_db = "assets/images/" . $new_file_name;
            $dbh->addInfographic($_POST["nome"], $img_path_for_db, $_POST["humanText"], $_POST["llmText"]);
            header("location: adminInfographics.php");
            exit;
    } else {
            die("Errore: C'è stato un problema nel caricamento del file.");
    }
}

require_once("../template/base.php");


?>