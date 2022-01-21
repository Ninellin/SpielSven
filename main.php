<?php

require __DIR__ . '/vendor/autoload.php';

use Games\GuessNumber;


try
{
    $game = new GuessNumber(1, 100);
    $game->runGame();

}catch (Exception $exception)
{
    print($exception);
}



function registerGames()
{
    var_dump(in_array("GuessNumber",get_declared_classes()));
}
