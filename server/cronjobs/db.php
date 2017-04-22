<?php
include_once($_SERVER["DOCUMENT_ROOT"] . "/wohnsinn/server/cronjobs/credentials.php");

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

function getFlats() {
    global $db;

    $flats = array();

    if ($result = $db->query("SELECT * FROM `flats`;")) {
        while ($flat = $result->fetch_row()) {
            $namedFlat = array();
            $namedFlat["id"] = $flat[0];
            $namedFlat["country"] = $flat[1];
            $namedFlat["latitude"] = $flat[2];
            $namedFlat["longitude"] = $flat[3];
            $namedFlat["cityName"] = $flat[4];
            $namedFlat["state"] = $flat[5];
            $namedFlat["searchFrom"] = $flat[6];
            $namedFlat["searchTo"] = $flat[7];
            $namedFlat["flatsize"] = $flat[8];
            $namedFlat["description"] = $flat[9];
            $namedFlat["furnished"] = $flat[10];
            $namedFlat["apiId"] = $flat[11];
            $namedFlat["membersManCount"] = $flat[12];
            $namedFlat["rent"] = $flat[13];
            $namedFlat["size"] = $flat[14];
            $namedFlat["title"] = $flat[15];
            $namedFlat["wantedAgeFrom"] = $flat[16];
            $namedFlat["wantedAgeTo"] = $flat[17];
            $namedFlat["wantedAmountEven"] = $flat[18];
            $flats[] = $namedFlat;
        }
        $result->close();
    }

    return $flats;
}