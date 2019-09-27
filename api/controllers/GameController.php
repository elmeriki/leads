<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, GET, DELETE, PUT, PATCH, OPTIONS');
    header('Access-Control-Allow-Headers: token, Content-Type');
    header('Access-Control-Max-Age: 1728000');
    header('Content-Length: 0');
    header('Content-Type: text/plain');
    die();
}

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');


include '../viewmodels/GameView.php';
include '../actions/action.php';

switch ($query) {
    case "fetch-all-open-brand-games":
        $gameView = new GameView();
        $games = $gameView->fetchOpenBrandGames();
        echo json_encode($games);
        break;
    case "fetch-all-open-brand-games-by-category":
        $gameView = new GameView();
        if (!empty($_GET['category'])) {
            $games = $gameView->fetchOpenBrandGamesByCategory($_GET['category']);
            echo json_encode($games);
        } else {
            echo json_encode(array("message" => "Error fetching client"));
        }
        break;
    case "fetch-by-launchcode":
        $gameView = new GameView();
        if (!empty($_GET['launchcode'])) {
            $game = $gameView->deleteGameByLaunchcode($_GET['launchcode']);
            echo json_encode($game);
        } else {
            echo json_encode(array("message" => "Error fetching game"));
        }
        break;
    case "delete-by-launchcode":
        $gameView = new GameView();
        if (!empty($_GET['launchcode'])) {
            $result = $gameView->deleteGameByLaunchcode($_GET['launchcode']);
            echo json_encode($result);
        } else {
            echo json_encode(array("message" => "Error fetching game"));
        }
        break;

    default:
        echo "Invalid option";
}
