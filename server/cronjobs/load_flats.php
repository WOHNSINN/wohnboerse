<?php
include_once("../bootstrap.php");
include_once($basePath . "cronjobs/credentials.php");
include($basePath . "cronjobs/db.php");

$response = file_get_contents(Credentials::$apiEndpoint);
$data = json_decode($response);
print_r($data);
$db = new DB();

if ($data) {
    $db->emptyTable();
}

foreach ($data->result as $flat) {
    $flatData = array();
    $flatData["country"]    = $flat->city->country;
    $flatData["latitude"]   = isset($flat->lat) ? $flat->lat : null;
    $flatData["longitude"]  = isset($flat->lng) ? $flat->lng : null;
    $flatData["city"]   = $flat->city->name;
    $flatData["state"]  = $flat->city->state;
    $flatData["searchFrom"]     = $flat->from;
    $flatData["searchTo"]   = isset($flat->to) ? $flat->to : null ;
    $flatData["flatsize"]   = $flat->flatSize;
    $flatData["description"]    = isset($flat->description) ? $flat->description : null;
    $flatData["furnished"]  = $flat->furnished;
    $flatData["apiId"]  = $flat->id;
    $flatData["membersManCount"]    = isset($flat->membersManCount) ? $flat->membersManCount : null;
    $flatData["rent"]   = $flat->rent;
    $flatData["size"]   = $flat->size;
    $flatData["title"]  = $flat->title;
    $flatData["wantedAgeFrom"]  = isset($flat->wantedAgeFrom) ? $flat->wantedAgeFrom : null;
    $flatData["wantedAgeTo"]    = isset($flat->wantedAgeTo) ? $flat->wantedAgeTo : null;
    $flatData["wantedAmountEven"]    = isset($flat->wantedAmountEven) ? $flat->wantedAmountEven : null;
    $flatData["imageUrl"] = isset($flat->image->urls->ORIGINAL->url) ? $flat->image->urls->ORIGINAL->url : null;
    if ($db->addEntry($flatData)) {}
}

