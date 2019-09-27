<?php

include '../../database/Connection.php';

class GameView
{
    function __construct()
    { }

    function fetchOpenBrandGames()
    {
        $connection = new Connection();
        $games = $connection->fetchOpenBrandGames();
        return $games;
    }

    function fetchOpenBrandGamesByCategory($category)
    {
        $connection = new Connection();
        $games = $connection->fetchOpenBrandGamesByCategory($category);
        return $games;
    }

    function fetchGameByLaunchcode($launchcode)
    {
        $connection = new Connection();
        $game = $connection->fetchByLaunchcode($launchcode);
        return $game;
    }

    function deleteGameByLaunchcode($launchcode)
    {
        $connection = new Connection();
        $result = $connection->deleteGameByLaunchcode($launchcode);
        return $result;
    }
}
