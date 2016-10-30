<?php

require("../classes/facade.php");
include("../config.php");

$arrIngrID = $_SESSION['ingrIdx'];

$strIngrIds = "(" . implode(",", array_map(function ($item) {
    return $item;
}, $arrIngrID)) . ")";

$lstRecette = facade::GetRecetteByMultipleIngrId($conn, $strIngrIds);
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