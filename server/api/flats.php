<?php
include_once("../bootstrap.php");
include_once($basePath . "cronjobs/db.php");

header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");


$db = new DB();
$response = array();
$flats = $db->getFlats();

foreach ($flats as $index => $flat) {
    foreach($flat as $key => $value) {
        if ($key != "image") {
            $flats[$index][$key] = utf8_encode($value);
        }
    }
}

$response["result"] = $flats;

print_r(json_encode($response));