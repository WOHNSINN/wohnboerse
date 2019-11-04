<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header("Content-Type: application/json;charset=UTF-8");

// mb_internal_encoding("UTF-8");
/* Display current internal character encoding */
echo mb_internal_encoding();

include_once("../bootstrap.php");
include_once($basePath . "cronjobs/credentials.php");
include($basePath . "cronjobs/db.php");

$opts = array('http' => array('header' => 'Accept-Charset: UTF-8, *;q=0'));
$context = stream_context_create($opts);


$response = file_get_contents(Credentials::$apiEndpoint, false, $context);
// echo $response;
$data = json_decode($response);
//var_dump($data);
$db = new DB();

if ($data) {
    $db->emptyTable();
}

foreach ($data->result as $flat) {
    $flatData = array();
    $flatData["country"]    = $flat->city->country;
    $flatData["latitude"]   = isset($flat->lat) ? $flat->lat : null;
    $flatData["longitude"]  = isset($flat->lng) ? $flat->lng : null;
    $flatData["city"]   = isset($flat->city->name) ? $flat->city->name : null;
    $flatData["state"]  = isset($flat->city->state) ? $flat->city->state : null;
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
    $flatData["profileName"] = isset($flat->profile->name) ? $flat->profile->name : null;
    if ($db->addEntry($flatData)) {}
}
//echo(json_encode($data->result));
