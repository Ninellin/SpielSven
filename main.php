<?php

require __DIR__ . '/vendor/autoload.php';

use Games\GuessNumber;


$autoGame = false;

if (isset($argv[1]) && $argv[1] === "auto")
{
    $autoGame = true;
}

try
{
    $game = new GuessNumber(1, 100, $autoGame);
    $game->runGame();

}catch (Exception $exception)
{
    print($exception);
}



function registerGames()
{
    var_dump(in_array("GuessNumber",get_declared_classes()));
}
