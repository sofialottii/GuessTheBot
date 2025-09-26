<?php

require_once("bootstrap.php");

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST["crea"])){
        $endDate = !empty($_POST["endDate"]) ? $_POST["endDate"] : null;
        $infographicIDs = isset($_POST["infographics"]) ? $_POST["infographics"] : [];
        $isActive = isset($_POST["isActive"]) ? true : false;

        if ($isActive){
            $dbh->deactivateAllEvents();
        }
        $idEvent = $dbh->addEvent($_POST["eventName"], $_POST["eventMode"], $isActive, $endDate);
        if ($_POST["eventMode"] == "fixed" && !empty($infographicIDs)) {
            
            $count = count($infographicIDs);
            $finalIDsToSave = [];

            if ($count > 10) {
                shuffle($infographicIDs);
                $finalIDsToSave = array_slice($infographicIDs, 0, 10);
            } else {
                $finalIDsToSave = $infographicIDs;
                $needed = 10 - $count;
                if ($needed > 0) {
                    $allInfographics = $dbh->getAllInfographics();        
                    $allInfographicIDs = array_column($allInfographics, 'InfographicID');

                    $candidateIDs = array_diff($allInfographicIDs, $finalIDsToSave); //così evitiamo duplicati
                    shuffle($candidateIDs);
                    $fillerIDs = array_slice($candidateIDs, 0, $needed); //prendiamo gli ID necessari
            
            
                    $finalIDsToSave = array_merge($finalIDsToSave, $fillerIDs);
                }
            }

            foreach ($finalIDsToSave as $infographicID) {
                $dbh->associateInfographicToEvent($idEvent, $infographicID);
            }
        }
        header("Location: adminEvents.php");
        exit;
    }
}



$templateParams["infographics"] = $dbh->getAllInfographics();

$templateParams["titolo"] = "Crea Evento";
$templateParams["nome"] = "contenutoCreaEvento.php";


require_once("../template/base.php");


?>