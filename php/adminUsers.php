<?php

require_once("bootstrap.php");

session_start();

$templateParams["users"] = $dbh->getAllUsersWithScores();



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

$templateParams["titolo"] = "Gestisci Utenti";
$templateParams["nome"] = "contenutoAdminUsers.php";


require_once("../template/base.php");


?>