<?php

require_once("../assets/db/database.php");

$dbh = new DatabaseHelper("localhost", "root", "", "GuessTheBot", 3306);
define("UPLOAD_DIR", __DIR__ . "/../uploads/");

?>