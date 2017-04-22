<?php
include_once("../bootstrap.php");
include_once($basePath . "cronjobs/credentials.php");
include($basePath . "cronjobs/db.php");

$response = file_get_contents(Credentials::$apiEndpoint);
$data = json_decode($response);
$db = new DB();

if ($data) {
    $db->emptyTable();
}

foreach ($data->result as $flat) {
    $flatData = array();
    $flatData["country"]    = utf8_decode( $flat->city->country );
    $flatData["latitude"]   = isset($flat->lat) ? $flat->lat : null;
    $flatData["longitude"]  = isset($flat->lng) ? $flat->lng : null;
    $flatData["city"]   = utf8_decode($flat->city->name);
    $flatData["state"]  = utf8_decode($flat->city->state);
    $flatData["searchFrom"]     = $flat->from;
    $flatData["searchTo"]   = isset($flat->to) ? $flat->to : null ;
    $flatData["flatsize"]   = $flat->flatSize;
    $flatData["description"]    = isset($flat->description) ? utf8_decode($flat->description) : null;
    $flatData["furnished"]  = utf8_decode($flat->furnished);
    $flatData["apiId"]  = $flat->id;
    $flatData["membersManCount"]    = isset($flat->membersManCount) ? $flat->membersManCount : null;
    $flatData["rent"]   = $flat->rent;
    $flatData["size"]   = $flat->size;
    $flatData["title"]  = utf8_decode($flat->title);
    $flatData["wantedAgeFrom"]  = isset($flat->wantedAgeFrom) ? $flat->wantedAgeFrom : null;
    $flatData["wantedAgeTo"]    = isset($flat->wantedAgeTo) ? $flat->wantedAgeTo : null;
    $flatData["wantedAmountEven"]    = isset($flat->wantedAmountEven) ? $flat->wantedAmountEven : null;
    $flatData["imageUrl"] = isset($flat->image->urls->ORIGINAL->url) ? $flat->image->urls->ORIGINAL->url : null;

    if ($db->addEntry($flatData)) {}
}

