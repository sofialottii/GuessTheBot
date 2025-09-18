<?php

require_once("bootstrap.php");

session_start();

$templateParams["infographics"] = $dbh->getAllInfographics();

$templateParams["titolo"] = "Gestisci Infografiche";
$templateParams["nome"] = "contenutoAdminInfographics.php";


require_once("../template/base.php");


?>