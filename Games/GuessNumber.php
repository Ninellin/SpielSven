<?php

namespace Games;

use Exception;
use Src\UserInOut;

class GuessNumber implements Game
{

    /**
     * @param $min
     * @param $max
     * @param $autoGame
     * @throws Exception
     */
    public function __construct($min, $max)
    {
        $this->correct = false;
        $this->higher = false;
        $this->counter = 0;
        $this->number = random_int($min, $max);
        $this->aiLowest = $min-1;
        $this->aiHighest = $max+1;
    }


    public function runGame()
    {
        $userInOut = new UserInOut();

        $autoGame = $userInOut->askUser("autoGame (y/n)");

        if ($autoGame === "y")
        {
            $mode = $userInOut->askUser("Mode (s/r)");

        }

        while (!$this->correct)
        {
            if ($autoGame === "y")
            {
                $this->guess = $this->getGuessFromAi($mode, $userInOut);

            }else
            {
                $this->guess = $this->getGuessFromUser($userInOut);
            }

            $this->counter++;

            if ($this->guess === $this->number)
            {
                $this->correct = true;

            }elseif ($this->guess > $this->number)
            {
                $this->higher = false;

            }else
            {
                $this->higher = true;
            }

            $this->answerUser($userInOut);
        }
    }


    private function getGuessFromUser(UserInOut $userInOut): int
    {
        $answer = $userInOut->askUser("Your guess: ");
        return intval($answer);
    }


    private function getGuessFromAi(string $mode, UserInOut $userInOut): int
    {
        if (isset($this->guess))
        {
            if ($this->higher)
            {
                $this->aiLowest = $this->guess;
            }else
            {
                $this->aiHighest = $this->guess;
            }
        }

        if ($mode === "s")
        {
            $number = round(($this->aiLowest + $this->aiHighest) /2);

        }elseif ($mode === "r")
        {
            $number = random_int($this->aiLowest+1, $this->aiHighest-1);
        }

        $userInOut->answerUser("AI guessed $number");

        return $number;

    }


    private function answerUser(UserInOut $userInOut)
    {
        if ($this->correct)
        {
            $userInOut->answerUser("\nYou are right. Congratulations!!\n");
            $userInOut->answerUser("\nYou needed $this->counter guesses\n");

        }elseif ($this->higher)
        {
            $userInOut->answerUser("\nHigher\n");

        }else
        {
            $userInOut->answerUser("\nLower\n");
        }

    }



}
