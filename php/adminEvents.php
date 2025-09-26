<?php

require_once("bootstrap.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    if(isset($_POST["activateEvent"])){
        $dbh->activateEvent($_POST["gameID"]);
        header("Location: adminEvents.php");
        exit;
    }
    
    if(isset($_POST["deleteEvent"])){
        $dbh->deleteEvent($_POST["gameID"]);
        header("Location: adminEvents.php");
        exit;
    }
}

$templateParams["events"] = $dbh->getAllEvents();

$templateParams["titolo"] = "Gestisci Eventi";
$templateParams["nome"] = "contenutoAdminEvents.php";


require_once("../template/base.php");

?>