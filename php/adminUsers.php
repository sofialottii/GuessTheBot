<?php

require_once("bootstrap.php");

session_start();

if (isset($_GET["IDGame"]) && $_GET["IDGame"] > 0) {
    
    $gameId = $_GET["IDGame"];
    if ($gameId > 0) {
        $templateParams["users"] = $dbh->getAllUsersWithScoresByEvent($gameId);
    }
} else {
    $templateParams["users"] = $dbh->getAllUsersWithScores();
}




if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["deleteUserID"])) {
    $userId = intval($_POST["deleteUserID"]);
    $dbh->deleteUser($userId);
    header("Location: adminUsers.php");
    exit();
}

if (isset($_POST["home"])) {
    header("Location: index.php");
    exit();
}


$templateParams["filtroAttuale"] = isset($_GET["IDGame"]) ? $_GET["IDGame"] : null;
$templateParams["eventiFiltro"] = $dbh->getAllEvents();
$templateParams["usersSummary"] = $dbh->getUsersSummary();

$templateParams["titolo"] = "Gestisci Utenti";
$templateParams["nome"] = "contenutoAdminUsers.php";


require_once("../template/base.php");


?>