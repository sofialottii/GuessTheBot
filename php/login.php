<?php

require_once("bootstrap.php");


session_start();

if (isset($_SESSION["Admin"])) {
    //utente già loggato (quindi ha cliccato su logout)
    unset($_SESSION["Admin"]);
    header("location: index.php");
    exit;
}

//tutta la gestione dei bottoni e dell'iscrizione
if(isset($_POST["accedi"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $errore = false;
    $login_result = $dbh->checkLogin($username, $password);
    //login fallito:
    if(count($login_result) == 0){
        $templateParams["errorelogin"] = "Errore! Controllare username e password";
    }
    //login riuscito:
    else{
        $_SESSION["Admin"] = $username;

        header("location: index.php");
        exit;
    }

}

if(isset($_POST["home"])){
    header("location: index.php");
    exit;
}

$templateParams["titolo"] = "Area Riservata";
$templateParams["nome"] = "contenutoLogin.php";


require_once("../template/base.php");

?>