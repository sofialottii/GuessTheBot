<?php

require_once("bootstrap.php");

session_start();

$templateParams["answers"] = $dbh->getAllAnswers();
$templateParams["advices"] = $dbh->getAllAdvices();

$templateParams["titolo"] = "Visualizza Risposte";
$templateParams["nome"] = "contenutoAdminAnswers.php";


require_once("../template/base.php");


?>