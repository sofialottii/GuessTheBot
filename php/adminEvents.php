<?php

require_once("bootstrap.php");

session_start();

$templateParams["titolo"] = "Gestisci Eventi";
$templateParams["nome"] = "contenutoAdminEvents.php";


require_once("../template/base.php");

?>