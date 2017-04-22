<?php
include_once("./credentials.php");

$db = new mysqli(Credentials::$dbHost, Credentials::$dbUser, Credentials::$dbPass, Credentials::$dbName, 3306);
if ($db->connect_errno) {
    echo "Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error;
}

function emptyTable() {
    global $db;

    $stmt = $db->prepare("DELETE FROM flats;");
    $stmt->execute();
}

function addEntry($data) {
    global $db;
    
    if (!($stmt = $db->prepare("INSERT INTO flats 
    (
        `country`,
        `latitude`,
        `longitude`,
        `city`,
        `state`,
        `search_from`,
        `search_to`,
        `flatsize`,
        `description`,
        `furnished`,
        `api_id`,
        `members_man_count`,
        `rent`,
        `size`,
        `title`,
        `wanted_age_from`,
        `wanted_age_to`,
        `wanted_amount_even`
    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))) {
        echo "Prepare failed: (" . $db->errno . ") " . $db->error;
    }

    if (!$stmt->bind_param("sddssssissiiiisiii", 
        $data["country"],
        $data["latitude"],
        $data["longitude"],
        $data["city"],
        $data["state"],
        $data["searchFrom"],
        $data["searchTo"],
        $data["flatsize"],
        $data["description"],
        $data["furnished"],
        $data["apiId"],
        $data["membersManCount"],
        $data["rent"],
        $data["size"],
        $data["title"],
        $data["wantedAgeFrom"],
        $data["wantedAgeTo"],
        $data["wantedAmountEven"]
        )) {
        echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    if (!$stmt->execute()) {
        echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
    }

    return true;
}