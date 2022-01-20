<?php

namespace Games;

use Exception;

class GuessNumber implements Game
{

    /**
     * @param $min
     * @param $max
     * @param $autoGame
     * @throws Exception
     */
    public function __construct($min, $max, $autoGame)
    {
        $this->autoGame = $autoGame;
        $this->correct = false;
        $this->higher = false;
        $this->counter = 0;
        $this->number = random_int($min, $max);
        $this->aiLowest = $min-1;
        $this->aiHighest = $max+1;
    }


    public function runGame()
    {
        while (!$this->correct)
        {
            if ($this->autoGame)
            {
                $this->guess = $this->getGuessFromAi();

            }else
            {
                $this->guess = $this->getGuessFromUser();
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

            $this->answerUser();
        }
    }


    private function getGuessFromUser(): int
    {
        $answer = readline("Your guess: ");
        return intval($answer);
    }


    private function getGuessFromAi(): int
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

        $number = random_int($this->aiLowest+1, $this->aiHighest-1);

        print("AI guessed $number");

        return $number;

    }


    private function answerUser()
    {
        if ($this->correct)
        {
            print("\nYou are right. Congratulations!!\n");
            print("\nYou needed $this->counter guesses\n");

        }elseif ($this->higher)
        {
            print("\nHigher\n");

        }else
        {
            print("\nLower\n");
        }

    }



}
