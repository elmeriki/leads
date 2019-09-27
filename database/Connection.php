<?php
class Connection
{
    private $connect = '';

    function __construct()
    {
        $this->database_connection();
    }

    function database_connection()
    {
        $pass = 'UJbv&KDubg6Z2p^g66!8Xu&tAmr3kU&JEFpPm7$T%N&t';
        $connectionString = "mysql:host=159.65.27.72;dbname=cms";
        $user = "games";
        $this->connect = new PDO($connectionString, $user, $pass);
    }

    function fetchOpenBrandGames()
    {
        $query = "SELECT name, launchcode, provider, rtp ".
        "FROM cms.game where launchcode ".
        "NOT IN (SELECT launchcode FROM cms.game_brand_block) LIMIT 20";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function fetchOpenBrandGamesByCategory($category)
    {
        $query = "SELECT g.name, g.launchcode, g.provider, g.rtp FROM cms.game g JOIN cms.brand_games bg ON g.launchcode = bg.launchcode WHERE bg.category = '$category' AND g.launchcode NOT IN (SELECT launchcode FROM cms.game_brand_block) LIMIT 20";
        $statement = $this->connect->prepare($query);
        if ($statement->execute()) {
            while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    function fetchByLaunchcode($launchcode)
    {
        try {
            $query = "SELECT * FROM cms.game WHERE launchcode='" . $launchcode . "'";
            $statement = $this->connect->prepare($query);
            if ($statement->execute()) {
                $data = array("message" => "Game with launchcode " . $launchcode . " not found.");
                foreach ($statement->fetchAll() as $row) {
                    $data['launchcode'] = $row['launchcode'];
                    $data['name'] = $row['name'];
                    $data['provider'] = $row['provider'];
                    $data['rtp'] = $row['rtp'];
                }

                return $data;
            }
        } catch (Exception $ex) {
            return array("message" => $ex->getMessage());
        }
    }


    function deleteGameByLaunchcode($launchcode)
    {
        $message = "";
        try {
            $query = "DELETE FROM cms.game  WHERE launchcode = '" . $launchcode . "'";
            $statement = $this->connect->prepare($query);
            $result = $statement->execute();

            if ($result) {
                $message = "Game successfully deleted.";
            } else {
                $message = "Game deletion not successful";
            }
        } catch (Exception $ex) {
            $message = "Error occured while deleting. " . $ex->getMessage();
        }
        return array("message" => $message);
    }
}
