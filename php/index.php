<?php

require_once("bootstrap.php");

session_start();

$templateParams["titolo"] = "Home";
$templateParams["nome"] = "contenutoIndex.php";


require_once("../template/base.php");

?>