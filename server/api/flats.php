<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/wohnsinn/server/cronjobs/db.php");

header("Content-Type: application/json");

$flats = getFlats();

foreach ($flats as $index => $flat) {
    foreach($flat as $key => $value) {
        $flats[$index][$key] = utf8_encode($value);
    }
}

print_r(json_encode($flats));