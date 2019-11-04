<?php
include_once("../bootstrap.php");
include_once($basePath . "cronjobs/credentials.php");

class DB {

    private $db = null;

    public function __construct() {
        $this->db = new mysqli(
            Credentials::$dbHost,
            Credentials::$dbUser,
            Credentials::$dbPass,
            Credentials::$dbName,
            Credentials::$dbPort);

        if ($this->db->connect_errno) {
            echo "Failed to connect to MySQL: (" . $this->db->connect_errno . ") " . $this->db->connect_error;
            exit();
        }

        // printf("Initial character set: %s\n", $this->db->character_set_name());
        if (!$this->db->set_charset("utf8")) {
            printf("Error loading character set utf8: %s\n", $this->db->error);
            exit();
        } else {
            // printf("Current character set: %s\n", $this->db->character_set_name());
        }
    }


    public function emptyTable() {
        $stmt = $this->db->prepare("DELETE FROM flats;");
        $stmt->execute();
    }

    public function addEntry($data) {
        if (!($stmt = $this->db->prepare("INSERT INTO flats
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
            `wanted_amount_even`,
            `image_url`,
            `profile_name`
        ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))) {
            echo "Prepare failed: (" . $db->errno . ") " . $db->error;
        }

        if (!$stmt->bind_param("sddssssissiiiisiiiss",
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
            $data["wantedAmountEven"],
            $data["imageUrl"],
            $data["profileName"]
            )) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }

        return true;
    }

    public function getFlats() {
        $flats = array();

        if ($result = $this->db->query("SELECT * FROM `flats` ORDER BY city ASC;")) {
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
                $namedFlat["image"] = array();
                $namedFlat["image"]["urls"] = array();
                $namedFlat["image"]["urls"]["S"] = array();
                $namedFlat["image"]["urls"]["S"]["url"] = $flat[19];
                $namedFlat["profileName"] = $flat[20];
                $flats[] = $namedFlat;
            }
            $result->close();
        }

        return $flats;
    }
}


