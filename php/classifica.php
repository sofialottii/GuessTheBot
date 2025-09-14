<?php

require_once("bootstrap.php");

$templateParams["titolo"] = "Classifica";
$templateParams["nome"] = "contenutoClassifica.php";
$classifica = $dbh->getLeaderboard();

require_once("../template/base.php");

?>