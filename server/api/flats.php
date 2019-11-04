<?php
include_once("../bootstrap.php");
include_once($basePath . "cronjobs/db.php");

header("Content-Type: application/json;charset=UTF-8");

$db = new DB();
$response = array();
$flats = $db->getFlats();

foreach ($flats as $index => $flat) {
    foreach($flat as $key => $value) {
        if ($key != "image") {
            $flats[$index][$key] = $value;
        }
    }
}

$response["result"] = $flats;

print_r(json_encode($response, JSON_UNESCAPED_UNICODE));