<?php

require("../classes/facade.php");
include("../config.php");

$fridgeID = $_SESSION["fridgeId"];

$lstRecette = facade::GetRecetteByFridge($conn, $fridgeID);
$rows = [];

foreach ($lstRecette as $row) {
    $rows[] = array_values((array)$row);
}

$arrayRecettes = array('data'=> $rows);
utilities::utf8_encode_deep($arrayRecettes);

echo json_encode(
    $arrayRecettes, JSON_PRETTY_PRINT
);



?>